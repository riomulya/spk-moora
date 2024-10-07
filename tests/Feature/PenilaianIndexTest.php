<?php

namespace Tests\Feature;

use App\Http\Livewire\Penilaian\Index;
use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PenilaianIndexTest extends TestCase
{
    use RefreshDatabase;

    protected $alternatifs;
    protected $kriterias;

    public function setUp(): void
    {
        parent::setUp();

        //? Membuat data dummy untuk Alternatif dan Kriteria
        $this->alternatifs = [
            Alternatif::create(['kode' => 'A1', 'name' => 'Alternatif 1']),
            Alternatif::create(['kode' => 'A2', 'name' => 'Alternatif 2']),
            Alternatif::create(['kode' => 'A3', 'name' => 'Alternatif 3']),
        ];

        $this->kriterias = [
            Kriteria::create(['kode' => 'C1', 'name' => 'Kriteria 1', 'type' => true, 'bobot' => 0.2]),
            Kriteria::create(['kode' => 'C2', 'name' => 'Kriteria 2', 'type' => false, 'bobot' => 0.3]),
            Kriteria::create(['kode' => 'C3', 'name' => 'Kriteria 3', 'type' => true, 'bobot' => 0.5]),
        ];
    }

    /**
     * @test
     * Mengetes apakah Livewire PenilaianIndex dapat menampilkan data Alternatif
     * dan Kriteria dengan benar.
     */
    public function it_renders_with_alternatifs_and_kriterias()
    {
        Livewire::test(Index::class)
            ->assertViewHas('alternatifs', function ($alternatifs) {
                //? Pastikan ada 3 alternatif yang dirender
                //? dan salah satunya memiliki nama 'Alternatif 1'
                return count($alternatifs) === 3 && $alternatifs->contains('name', 'Alternatif 1');
            })
            ->assertViewHas('kriterias', function ($kriterias) {
                //? Pastikan ada 3 kriteria yang dirender
                //? dan salah satunya memiliki nama 'Kriteria 1'
                return count($kriterias) === 3 && $kriterias->contains('name', 'Kriteria 1');
            });
    }

    /**
     * @test
     *
     * Mengetes apakah Livewire PenilaianIndex menampilkan data Alternatif
     * dan Kriteria di dalam view dengan benar.
     */
    public function it_displays_alternatifs_and_kriterias_in_view()
    {
        Livewire::test(Index::class)
            ->assertSee('A1') //? Alternatif 1
            ->assertSee('A2') //? Alternatif 2
            ->assertSee('A3') //? Alternatif 3
            ->assertSee('C1') //? Kriteria 1
            ->assertSee('C2') //? Kriteria 2
            ->assertSee('C3'); //? Kriteria 3
    }
}
