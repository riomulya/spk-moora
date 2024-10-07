<?php

namespace Tests\Feature;

use App\Http\Livewire\Alternatif\Create;
use App\Models\Alternatif;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AlternatifCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * Mengetes apakah Livewire AlternatifCreate dapat membuat data alternatif
     * dengan benar.
     */
    public function it_can_create_a_new_alternatif()
    {
        //? Membuat instance Livewire AlternatifCreate
        $livewire = Livewire::test(Create::class);

        //? Meng-set data alternatif yang akan di-create
        $livewire->set('kode', 'A1')
            ->set('nama', 'Alternatif 1');

        //? Memanggil fungsi store untuk men-create data alternatif
        $livewire->call('store');

        //? Memastikan bahwa data alternatif telah di-create di database
        $this->assertDatabaseHas('alternatifs', [
            'kode' => 'A1',
            'name' => 'Alternatif 1',
        ]);
    }

    /**
     * @test
     *
     * Mengetes apakah Livewire AlternatifCreate dapat mereset form setelah
     * data alternatif di-create.
     */
    public function it_resets_fields_after_saving()
    {
        //? Membuat instance Livewire AlternatifCreate
        $livewire = Livewire::test(Create::class);

        //? Meng-set data alternatif yang akan di-create
        $livewire->set('kode', 'A1')
            ->set('nama', 'Alternatif 1');

        //? Memanggil fungsi store untuk men-create data alternatif
        $livewire->call('store');

        //? Memastikan bahwa form telah di-reset
        $livewire->assertSet('kode', '')
            ->assertSet('nama', '');
    }

    /**
     * @test
     *
     * Mengetes apakah Livewire AlternatifCreate melakukan validasi dengan benar
     * saat meng-create data alternatif.
     */
    public function it_validates_required_fields()
    {
        //? Membuat instance Livewire AlternatifCreate
        $livewire = Livewire::test(Create::class);

        //? Membuat data dummy yang tidak valid
        //? kode dan name alternatif kosong
        $livewire->set('kode', '')
            ->set('nama', '');

        //? Memanggil fungsi store untuk men-create data alternatif
        $livewire->call('store');

        //? Memastikan bahwa Livewire AlternatifCreate akan mengembalikan error
        //? jika data yang di-input tidak valid
        $livewire->assertHasErrors([
            'kode' => 'required',
            'nama' => 'required',
        ]);
    }
}
