<?php

namespace Tests\Feature;

use App\Http\Livewire\Kriteria\Edit;
use App\Models\Kriteria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class KriteriaEditTest extends TestCase
{
    use RefreshDatabase;

    protected $kriteria;

    /**
     * Set up the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        //? Membuat data dummy Kriteria
        //? Data dummy ini akan digunakan dalam setiap test
        //? untuk menguji apakah Livewire Kriteria Edit dapat
        //? menampilkan data dengan benar dan mengupdate data
        //? dengan benar.
        $this->kriteria = Kriteria::create([
            'kode' => 'C1',
            'name' => 'Kriteria 1',
            'bobot' => 0.5,
            'type' => true,
        ]);
    }

    /**
     * Mengetes apakah Livewire Kriteria Edit mengatur data dengan benar
     * saat di-mount.
     *
     * @test
     */
    public function it_mounts_with_correct_data()
    {
        //? Fungsi ini untuk testing apakah data dummy yang di-set di Livewire
        //? Kriteria Edit sesuai dengan data yang diharapkan
        Livewire::test(Edit::class, ['id' => $this->kriteria->id])
            ->assertSet('kriteria.id', $this->kriteria->id)
            ->assertSet('kriteria.kode', 'C1')
            ->assertSet('kriteria.name', 'Kriteria 1')
            ->assertSet('kriteria.bobot', 0.5)
            ->assertSet('kriteria.type', true);
    }

    /**
     * Mengetes apakah Livewire Kriteria Edit melakukan validasi dengan benar
     * saat mengupdate data kriteria.
     *
     * @test
     */
    public function it_validates_kriteria_when_updating()
    {
        //? Fungsi ini untuk testing apakah Livewire Kriteria Edit akan
        //? memvalidasi input yang kosong dan mengembalikan error

        //? Membuat instance Livewire Kriteria Edit dengan meng-passing id kriteria
        $livewire = Livewire::test(Edit::class, ['id' => $this->kriteria->id]);

        //? Membuat data dummy yang tidak valid
        //? kode, name, dan bobot kriteria kosong
        $livewire->set('kriteria.kode', '')
            ->set('kriteria.name', '')
            ->set('kriteria.bobot', '');

        //? Memanggil fungsi update untuk men-update data kriteria
        $livewire->call('update');

        //? Memastikan bahwa Livewire Kriteria Edit akan mengembalikan error
        //? jika data yang di-input tidak valid
        $livewire->assertHasErrors([
            'kriteria.kode' => 'required',
            'kriteria.name' => 'required',
            'kriteria.bobot' => 'required',
        ]);
    }

    /**
     * Test apakah Livewire Kriteria Edit dapat mengupdate data Kriteria yang sesuai.
     *
     * @test
     */
    public function it_updates_kriteria_correctly()
    {
        //? Membuat instance Livewire Kriteria Edit dengan meng-passing id kriteria
        $livewire = Livewire::test(Edit::class, ['id' => $this->kriteria->id]);

        //? Membuat data dummy yang akan di-update
        //? kode, name, bobot, dan type kriteria di-update dengan nilai yang baru
        $livewire->set('kriteria.kode', 'C2')
            ->set('kriteria.name', 'Kriteria Baru')
            ->set('kriteria.bobot', 0.7)
            ->set('kriteria.type', false);

        //? Memanggil fungsi update untuk men-update data kriteria
        $livewire->call('update');

        //? Memastikan bahwa data Kriteria sudah diperbarui di database
        $this->assertDatabaseHas('kriterias', [
            'id' => $this->kriteria->id,
            'kode' => 'C2',
            'name' => 'Kriteria Baru',
            'bobot' => 0.7,
            'type' => false,
        ]);
    }
}
