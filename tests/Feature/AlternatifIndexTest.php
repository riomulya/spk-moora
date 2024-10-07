<?php

namespace Tests\Feature;

use App\Http\Livewire\Alternatif\Index;
use App\Models\Alternatif;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AlternatifIndexTest extends TestCase
{
    use RefreshDatabase;

    protected $alternatifs;

    public function setUp(): void
    {
        parent::setUp();

        //? Membuat data dummy untuk Alternatif
        $this->alternatifs = [
            Alternatif::create(['kode' => 'A1', 'name' => 'Alternatif 1']),
            Alternatif::create(['kode' => 'A2', 'name' => 'Alternatif 2']),
            Alternatif::create(['kode' => 'A3', 'name' => 'Alternatif 3']),
        ];
    }

    /** @test */
    public function it_renders_with_alternatifs()
    {
        Livewire::test(Index::class)
            ->assertViewHas('alternatifs', function ($alternatifs) {
                return count($alternatifs) === 3; //? Pastikan ada 3 alternatif yang dirender
            });
    }

    /** @test */
    public function it_can_delete_an_alternatif()
    {
        $alternatifToDelete = $this->alternatifs[0]; //? Mengambil alternatif pertama

        Livewire::test(Index::class)
            ->call('delete', $alternatifToDelete->id); //? Memanggil fungsi delete dengan id alternatif

        //? Memastikan bahwa alternatif sudah dihapus dari database
        $this->assertDatabaseMissing('alternatifs', [
            'id' => $alternatifToDelete->id,
        ]);
    }
}
