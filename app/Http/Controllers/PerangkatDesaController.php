<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;

class PerangkatDesaController extends Controller
{
    public function index()
    {
        $page = 'perangkat';
        $perangkat = Anggota::all();
        return view('perangkat.index', compact('page', 'perangkat'));
    }

    public function create()
    {
        $page = 'perangkat';
        return view('perangkat.create', compact('page'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required',
            'jabatan' => 'required',
            'nip' => 'nullable',
            'kontak' => 'nullable',
            'periode_mulai' => 'nullable|date',
            'periode_selesai' => 'nullable|date',
        ]);

        Anggota::create($request->all());
        return redirect()->route('perangkat.index')->with('success', 'Data perangkat desa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $page = 'perangkat';
        $perangkat = Anggota::findOrFail($id);
        return view('perangkat.edit', compact('page', 'perangkat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'warga_id' => 'required',
            'jabatan' => 'required',
        ]);

        $perangkat = Anggota::findOrFail($id);
        $perangkat->update($request->all());

        return redirect()->route('perangkat.index')->with('success', 'Data perangkat desa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $perangkat = Anggota::findOrFail($id);
        $perangkat->delete();
        return redirect()->route('perangkat.index')->with('success', 'Data perangkat desa berhasil dihapus.');
    }
}
