<?php

namespace Tests\Feature;

use App\Http\Livewire\Alternatif\Edit;
use App\Models\Alternatif;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AlternatifEditTest extends TestCase
{
    use RefreshDatabase;

    protected $alternatif;

    /**
     * Set up the test
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        //? Membuat data dummy untuk Alternatif
        //? Data dummy ini akan digunakan dalam setiap test
        $this->alternatif = Alternatif::create([
            'kode' => 'A1',
            'name' => 'Alternatif 1'
        ]);
    }

    /**
     * @test
     *
     * Mengetes apakah Livewire AlternatifEdit mengatur data dengan benar
     * saat di-mount.
     */
    public function it_mounts_with_correct_data()
    {
        //? Membuat instance Livewire AlternatifEdit
        //? dengan meng-passing id alternatif yang akan di-edit
        $livewire = Livewire::test(Edit::class, ['id' => $this->alternatif->id]);

        //? Memastikan bahwa data yang di-set di Livewire adalah benar
        $livewire->assertSet('alternatif.id', $this->alternatif->id)
            ->assertSet('alternatif.kode', 'A1')
            ->assertSet('alternatif.name', 'Alternatif 1');
    }

    /**
     * @test
     *
     * Mengetes apakah Livewire AlternatifEdit melakukan validasi dengan benar
     * saat meng-update data alternatif.
     */
    public function it_validates_required_fields_when_updating()
    {
        //? Membuat instance Livewire AlternatifEdit
        //? dengan meng-passing id alternatif yang akan di-edit
        $livewire = Livewire::test(Edit::class, ['id' => $this->alternatif->id]);

        //? Membuat data dummy yang tidak valid
        //? kode dan name alternatif kosong
        $livewire->set('alternatif.kode', '')
            ->set('alternatif.name', '');

        //? Memastikan bahwa Livewire AlternatifEdit akan mengembalikan error
        //? jika data yang di-input tidak valid
        $livewire->call('update')
            ->assertHasErrors(['alternatif.kode' => 'required', 'alternatif.name' => 'required']);
    }

    /**
     * @test
     *
     * Mengetes apakah Livewire AlternatifEdit dapat meng-update data alternatif
     * dengan benar.
     */
    public function it_updates_alternatif_correctly()
    {
        //? Membuat instance Livewire AlternatifEdit
        //? dengan meng-passing id alternatif yang akan di-edit
        $livewire = Livewire::test(Edit::class, ['id' => $this->alternatif->id]);

        //? Meng-update data alternatif dengan data dummy yang valid
        //? kode dan name alternatif di-update dengan nilai yang baru
        $livewire->set('alternatif.kode', 'A2')
            ->set('alternatif.name', 'Alternatif 2')
            ->call('update');

        //? Memastikan bahwa data alternatif telah diperbarui di database
        $this->assertDatabaseHas('alternatifs', [
            'kode' => 'A2',
            'name' => 'Alternatif 2',
        ]);
    }
}
