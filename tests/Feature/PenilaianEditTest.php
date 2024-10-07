<?php

namespace Tests\Feature;

use App\Http\Livewire\Penilaian\Edit;
use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PenilaianEditTest extends TestCase
{
    use RefreshDatabase;

    protected $alternatif;
    protected $kriterias;

    /**
     * Setup the test environment
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        //? Membuat data dummy Alternatif
        //? Data dummy ini akan digunakan dalam setiap test
        $this->alternatif = Alternatif::create(['kode' => 'A1', 'name' => 'Alternatif 1']);

        //? Membuat data dummy Kriteria
        //? Data dummy ini akan digunakan dalam setiap test
        $this->kriterias = [
            Kriteria::create(['kode' => 'C1', 'name' => 'Kriteria 1', 'type' => true, 'bobot' => 0.2]),
            Kriteria::create(['kode' => 'C2', 'name' => 'Kriteria 2', 'type' => false, 'bobot' => 0.3]),
            Kriteria::create(['kode' => 'C3', 'name' => 'Kriteria 3', 'type' => true, 'bobot' => 0.5]),
        ];

        //? Menyambungkan Alternatif dengan Kriteria dan nilai
        //? Nilai akan diisi secara random
        foreach ($this->kriterias as $kriteria) {
            $this->alternatif->kriteria()->attach($kriteria->id, ['nilai' => rand(1, 10)]);
        }
    }

    /** @test */
    public function it_mounts_with_correct_data()
    {
        Livewire::test(Edit::class, ['altId' => $this->alternatif->id])
            ->assertSet('alternatif.id', $this->alternatif->id)
            ->assertCount('kriterias', 3)
            ->assertSee('Alternatif 1');
    }

    /** @test */
    public function it_validates_nilai_when_updating()
    {
        Livewire::test(Edit::class, ['altId' => $this->alternatif->id])
            ->set('nilai', [
                $this->kriterias[0]->id => 5,
                $this->kriterias[1]->id => '',
                $this->kriterias[2]->id => 7,
            ])
            ->call('update')
            ->assertHasErrors(['nilai.' . $this->kriterias[1]->id => 'required']);
    }

    /**
     * Mengetes apakah Livewire PenilaianEdit dapat meng-update data nilai
     * dengan benar.
     *
     * @test
     */
    public function it_updates_nilai_correctly()
    {
        //? Membuat instance Livewire PenilaianEdit
        //? dengan meng-passing id alternatif yang akan di-edit
        Livewire::test(Edit::class, ['altId' => $this->alternatif->id])
            ->set('nilai', [
                $this->kriterias[0]->id => 6,
                $this->kriterias[1]->id => 8,
                $this->kriterias[2]->id => 7,
            ])
            ->call('update');

        //? Memastikan bahwa nilai-nilai di pivot table sudah diperbarui
        $this->assertDatabaseHas('alternatif_kriteria', [
            'alternatif_id' => $this->alternatif->id,
            'kriteria_id' => $this->kriterias[0]->id,
            'nilai' => 6,
        ]);

        $this->assertDatabaseHas('alternatif_kriteria', [
            'alternatif_id' => $this->alternatif->id,
            'kriteria_id' => $this->kriterias[1]->id,
            'nilai' => 8,
        ]);

        $this->assertDatabaseHas('alternatif_kriteria', [
            'alternatif_id' => $this->alternatif->id,
            'kriteria_id' => $this->kriterias[2]->id,
            'nilai' => 7,
        ]);
    }
}
