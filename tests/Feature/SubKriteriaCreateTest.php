<?php

namespace Tests\Feature;

use App\Http\Livewire\Subkriteria\Create;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubkriteriaCreateTest extends TestCase
{
    use RefreshDatabase;
    protected $kriteria;
    /**
     * TODO: Set up the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        //? ? Membuat data Kriteria dan SubKriteria secara manual
        //? ? Data dummy ini akan digunakan dalam setiap test
        $this->kriteria = Kriteria::create([
            'kode' => 'C1',
            'name' => 'Kriteria 1',
            'type' => true,
            'bobot' => 0.2,
        ]);
    }


    /**
     * TODO: Test apakah Livewire SubKriteriaCreate dapat men-set kriteria_id
     * TODO:engan benar saat di-mount.
     *
     * @test
     */
    public function test_mount_sets_kriteria_id()
    {
        //? ?: Membuat instance Livewire SubKriteriaCreate dengan meng-passing
        //? ? id kriteria
        Livewire::test(Create::class, ['kriteria' => $this->kriteria->id])
            ->assertSet('kriteria_id', $this->kriteria->id);
    }

    /**
     * TODO:Test apakah Livewire SubKriteriaCreate dapat membuat data subkriteria
     * TODO: dengan benar.
     *
     * @test
     */
    public function test_store_creates_subkriteria()
    {
        //? ? Membuat data Kriteria manual
        $kriteria = Kriteria::create([
            'kode' => 'C1',
            'name' => 'Kriteria 1',
            'type' => true,
            'bobot' => 0.2,
        ]);

        //? ? Membuat instance Livewire SubKriteriaCreate dengan meng-passing
        //? ? id kriteria
        $livewire = Livewire::test(Create::class, ['kriteria' => $kriteria->id]);

        //? ? Meng-set data subkriteria yang akan di-create
        $livewire->set('name', 'Subkriteria Test')
            ->set('bobot', 0.5);

        //? ? Memanggil fungsi store untuk men-create data subkriteria
        $livewire->call('store');

        //? ? Memastikan bahwa data subkriteria sudah di-create di database
        $this->assertDatabaseHas('sub_kriterias', [
            'kriteria_id' => $kriteria->id,
            'name' => 'Subkriteria Test',
        ]);
    }


    /**
     * todo: Test apakah Livewire SubKriteriaCreate dapat meng-reset input form
     * todo: setelah data subkriteria di-create.
     *
     * @test
     */
    public function test_store_resets_input_fields()
    {
        //? Membuat instance Livewire SubKriteriaCreate dengan meng-passing
        //? id kriteria
        Livewire::test(Create::class, ['kriteria' => $this->kriteria->id])
            //? Meng-set data subkriteria yang akan di-create
            ->set('name', 'Subkriteria Test')
            ->set('bobot', 0.5)
            //? Memanggil fungsi store untuk men-create data subkriteria
            ->call('store')
            //? Memastikan bahwa form telah di-reset
            ->assertSet('name', '')
            ->assertSet('bobot', '');
    }


    /**
     * Test apakah Livewire SubKriteriaCreate dapat menghapus data subkriteria
     * dengan benar.
     *
     * @test
     */
    public function test_delete_subkriteria()
    {
        //? Membuat data SubKriteria manual
        $subkriteria = SubKriteria::create([
            'kriteria_id' => $this->kriteria->id,
            'name' => 'Subkriteria Test',
            'bobot' => 0.3,
        ]);

        //? Membuat instance Livewire SubKriteriaCreate dengan meng-passing
        //? id kriteria
        Livewire::test(Create::class, ['kriteria' => $this->kriteria->id])
            //? Memanggil fungsi delete untuk menghapus data subkriteria
            ->call('delete', $subkriteria->id);

        //? Memastikan bahwa data subkriteria sudah dihapus dari database
        $this->assertDatabaseMissing('sub_kriterias', [
            'id' => $subkriteria->id,
        ]);
    }

    /**
     * TODO: Test apakah Livewire SubKriteriaCreate dapat menampilkan view yang benar.
     *
     * @test
     */
    public function test_render_displays_correct_view()
    {
        //? Membuat instance Livewire SubKriteriaCreate dengan meng-passing
        //? id kriteria
        Livewire::test(Create::class, ['kriteria' => $this->kriteria->id])
            //? Memastikan bahwa view yang di-render adalah view yang benar
            ->assertViewIs('livewire.subkriteria.create')
            //? Memastikan bahwa data kriteria yang di-passing sesuai dengan
            //? data yang di-render
            ->assertViewHas('kriteria', $this->kriteria);
    }
}
