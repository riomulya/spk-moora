<?php

namespace App\Http\Livewire\Proses;

use App\Models\Alternatif;
use App\Models\Kriteria;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

class Index extends Component
{
    public function render()
    {
        $alternatifs = $this->proses();
        return view('livewire.proses.index', compact('alternatifs'));
    }

    public function print()
    {
        // abaikan garis error di bawah 'Pdf' jika ada.
        $pdf = Pdf::loadView('laporan.cetak', ['data' => $this->proses()])->output();
        // return $pdf->download('Laporan.pdf');
        return response()->streamDownload(fn() => print($pdf), 'Laporan.pdf');
    }

    // proses metode MOORA
    public function proses()
    {
        $alternatifs = Alternatif::orderBy('kode')->get();
        $kriterias = Kriteria::orderBy('kode')->get()->toArray();

        // Membuat matriks keputusan
        $matriks = [];
        foreach ($alternatifs as $ka => $alt) {
            foreach ($alt->kriteria as $kk => $krit) {
                $matriks[$kk][$ka] = $krit->pivot->nilai;
            }
        }

        // Normalisasi matriks
        $matriks_normalisasi = [];
        foreach ($matriks as $kb => $baris) {
            $sum = 0;
            foreach ($baris as $kk => $kolom) {
                $sum += pow($kolom, 2);
            }
            $c = sqrt($sum);

            foreach ($baris as $kk => $kolom) {
                $matriks_normalisasi[$kb][] = $kolom / $c;
            }
        }

        // Optimalisasi nilai attribute
        $optimalisasi = [];
        foreach ($matriks_normalisasi as $kb => $baris) {
            // Pastikan tidak ada akses di luar indeks yang ada
            if (!isset($kriterias[$kb])) {
                continue;
            }

            foreach ($baris as $kk => $kolom) {
                $optimalisasi[$kk][] = $kolom * $kriterias[$kb]['bobot'];
            }
        }

        // Mengurangkan nilai min dan max
        $minmax = [];
        foreach ($optimalisasi as $kb => $baris) {
            $min = 0;
            $max = 0;
            foreach ($baris as $kk => $kolom) {
                if ($kriterias[$kk]['type'] == true) {
                    $max += $kolom;
                } else {
                    $min += $kolom;
                }
            }
            $Yi = $max - $min;
            $minmax[] = $Yi;
        }

        foreach ($alternatifs as $key => $alternatif) {
            $alternatif->nilai = $minmax[$key];
        }

        return $alternatifs;
    }
}
