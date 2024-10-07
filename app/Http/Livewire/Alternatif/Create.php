<?php

namespace App\Http\Livewire\Alternatif;

use App\Models\Alternatif;
use Livewire\Component;

class Create extends Component
{
	// variabel penampung data dari input
	public $kode;
	public $nama;

	public function render()
	{
		return view('livewire.alternatif.create');
	}

	// method untuk simpan data alternatif
	public function store()
	{
		// Validasi input
		$this->validate([
			'kode' => 'required',
			'nama' => 'required',
		]);

		Alternatif::create([
			'kode'	=> $this->kode,
			'name'	=> $this->nama
		]);
		$this->reset();
		$this->emit('saved');
	}
}
