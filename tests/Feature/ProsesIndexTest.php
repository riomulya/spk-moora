<?php

namespace Tests\Feature;

use App\Http\Livewire\Proses\Index;
use App\Models\Alternatif;
use App\Models\Kriteria;
use Livewire\Livewire;
use Tests\TestCase;

class ProsesIndexTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        //? Membuat data dummy jika tidak ada data di database
        if (Alternatif::count() === 0) {
            Alternatif::create(['kode' => 'A1', 'name' => 'Alternatif 1']);
            Alternatif::create(['kode' => 'A2', 'name' => 'Alternatif 2']);
            Alternatif::create(['kode' => 'A3', 'name' => 'Alternatif 3']);
            Alternatif::create(['kode' => 'A4', 'name' => 'Alternatif 4']);
        }

        if (Kriteria::count() === 0) {
            Kriteria::create(['kode' => 'C1', 'name' => 'Kriteria 1', 'type' => true, 'bobot' => 0.2]);
            Kriteria::create(['kode' => 'C2', 'name' => 'Kriteria 2', 'type' => false, 'bobot' => 0.2]);
            Kriteria::create(['kode' => 'C3', 'name' => 'Kriteria 3', 'type' => true, 'bobot' => 0.2]);
            Kriteria::create(['kode' => 'C4', 'name' => 'Kriteria 4', 'type' => false, 'bobot' => 0.2]);
            Kriteria::create(['kode' => 'C5', 'name' => 'Kriteria 5', 'type' => true, 'bobot' => 0.2]);
        }

        //? Menambahkan nilai pivot untuk alternatif dan kriteria
        foreach (Alternatif::all() as $alternatif) {
            foreach (Kriteria::all() as $kriteria) {
                $alternatif->kriteria()->attach($kriteria->id, ['nilai' => rand(1, 10)]);
            }
        }
    }

    public function test_proses_method_computes_correctly()
    {
        Livewire::test(Index::class)
            ->call('proses')
            ->assertViewHas('alternatifs', function ($alternatifs) {
                //? Memeriksa apakah setiap alternatif memiliki atribut 'nilai'
                foreach ($alternatifs as $alternatif) {
                    if (!isset($alternatif->nilai)) {
                        return false;
                    }
                }
                return true;
            });
    }

    public function test_print_method_generates_pdf()
    {
        $response = Livewire::test(Index::class)
            ->call('print');

        //? Memastikan bahwa response adalah stream PDF berupa aplication/json yang dirender ke pdf
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/json');
    }
}
