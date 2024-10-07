<?php

namespace Tests\Feature;

use App\Http\Livewire\Kriteria\Index;
use App\Models\Kriteria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class KriteriaIndexTest extends TestCase
{
    use RefreshDatabase;

    protected $kriterias;

    /**
     * Set up the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        //? Membuat data dummy untuk Kriteria
        //? Data dummy ini akan digunakan untuk menguji apakah Livewire Index
        //? dapat menampilkan data kriteria dengan benar.
        $this->kriterias = [
            Kriteria::create(['kode' => 'C1', 'name' => 'Kriteria 1', 'type' => true, 'bobot' => 0.2]),
            Kriteria::create(['kode' => 'C2', 'name' => 'Kriteria 2', 'type' => false, 'bobot' => 0.3]),
            Kriteria::create(['kode' => 'C3', 'name' => 'Kriteria 3', 'type' => true, 'bobot' => 0.5]),
        ];
    }

    /**
     * Test apakah Livewire Index dapat menampilkan data kriteria dengan benar.
     *
     * @test
     */
    public function it_renders_with_kriterias()
    {
        //? Memastikan bahwa Livewire Index dapat menampilkan data kriteria
        //? dengan benar.
        Livewire::test(Index::class)
            ->assertViewHas('kriterias', function ($kriterias) {
                //? Pastikan ada 3 kriteria yang dirender
                return count($kriterias) === 3;
            });
    }

    /**
     * Test apakah Livewire Index dapat menghapus data kriteria dengan benar.
     *
     * @test
     */
    public function it_can_delete_a_kriteria()
    {
        //? Mengambil kriteria pertama untuk dihapus
        $kriteriaToDelete = $this->kriterias[0];

        //? Memanggil fungsi delete dengan id kriteria
        Livewire::test(Index::class)
            ->call('delete', $kriteriaToDelete->id);

        //? Memastikan bahwa kriteria sudah dihapus dari database
        $this->assertDatabaseMissing('kriterias', [
            'id' => $kriteriaToDelete->id,
        ]);
    }
}
