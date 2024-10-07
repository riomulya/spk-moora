<?php

namespace Tests\Feature;

use App\Http\Livewire\Kriteria\Create;
use App\Models\Kriteria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class KriteriaCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test apakah Livewire KriteriaCreate dapat membuat data kriteria
     * dengan benar.
     *
     * @test
     */
    public function it_can_create_a_new_kriteria()
    {
        Livewire::test(Create::class)
            ->set('kode', 'C1')
            ->set('nama', 'Kriteria 1')
            ->set('bobot', 0.5)
            ->set('type', '1')
            ->call('store');

        //? Memastikan bahwa data kriteria telah di-create di database
        $this->assertDatabaseHas('kriterias', [
            'kode' => 'C1',
            'name' => 'Kriteria 1',
            'bobot' => 0.5,
            'type' => true,
        ]);
    }
    /**
     * Test apakah Livewire KriteriaCreate dapat mereset form setelah
     * data kriteria di-create.
     *
     * @test
     */
    public function it_resets_fields_after_saving()
    {
        //? Membuat instance Livewire KriteriaCreate
        $livewire = Livewire::test(Create::class);

        //? Meng-set data kriteria yang akan di-create
        $livewire->set('kode', 'C1')
            ->set('nama', 'Kriteria 1')
            ->set('bobot', 0.5)
            ->set('type', '1');

        //? Memanggil fungsi store untuk men-create data kriteria
        $livewire->call('store');

        //? Memastikan bahwa form telah di-reset
        $livewire->assertSet('kode', '')
            ->assertSet('nama', '')
            ->assertSet('bobot', '')
            ->assertSet('type', '1');
    }

    /**
     * Test apakah Livewire KriteriaCreate melakukan validasi dengan benar
     * saat meng-create data kriteria.
     *
     * @test
     */
    public function it_validates_required_fields()
    {
        //? Membuat instance Livewire KriteriaCreate
        $livewire = Livewire::test(Create::class);

        //? Meng-set data kriteria yang tidak valid (kosong)
        $livewire->set('kode', '')
            ->set('nama', '')
            ->set('bobot', '');

        //? Memanggil fungsi store untuk men-create data kriteria
        $livewire->call('store');

        //? Memastikan bahwa Livewire KriteriaCreate akan mengembalikan error
        //? jika data yang di-input tidak valid
        $livewire->assertHasErrors([
            'kode' => 'required',
            'nama' => 'required',
            'bobot' => 'required',
        ]);
    }
}
