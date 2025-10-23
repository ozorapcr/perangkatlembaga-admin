<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perangkat;

class PerangkatController extends Controller
{
    /**
     * Menampilkan semua data perangkat desa.
     */
    public function index()
    {
        $data = Perangkat::all();

        return view('perangkat.index', [
            'page' => 'perangkat',
            'data' => $data
        ]);
    }

    /**
     * Menampilkan form tambah perangkat.
     */
    public function create()
    {
        return view('perangkat.create', ['page' => 'perangkat']);
    }

    /**
     * Simpan data perangkat baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|integer',
            'jabatan' => 'required|string|max:100',
            'nip' => 'nullable|string|max:50',
            'kontak' => 'nullable|string|max:20',
            'periode_mulai' => 'nullable|date',
            'periode_selesai' => 'nullable|date',
        ]);

        Perangkat::create([
            'warga_id' => $request->warga_id,
            'jabatan' => $request->jabatan,
            'nip' => $request->nip,
            'kontak' => $request->kontak,
            'periode_mulai' => $request->periode_mulai,
            'periode_selesai' => $request->periode_selesai,
        ]);

        return redirect()->route('perangkat.index')->with('success', 'Data perangkat berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit perangkat.
     */
    public function edit(Perangkat $perangkat)
    {
        return view('perangkat.edit', [
            'page' => 'perangkat',
            'perangkat' => $perangkat
        ]);
    }

    /**
     * Update data perangkat yang sudah ada.
     */
    public function update(Request $request, Perangkat $perangkat)
    {
        $request->validate([
            'warga_id' => 'required|integer',
            'jabatan' => 'required|string|max:100',
            'nip' => 'nullable|string|max:50',
            'kontak' => 'nullable|string|max:20',
            'periode_mulai' => 'nullable|date',
            'periode_selesai' => 'nullable|date',
        ]);

        $perangkat->update([
            'warga_id' => $request->warga_id,
            'jabatan' => $request->jabatan,
            'nip' => $request->nip,
            'kontak' => $request->kontak,
            'periode_mulai' => $request->periode_mulai,
            'periode_selesai' => $request->periode_selesai,
        ]);

        return redirect()->route('perangkat.index')->with('success', 'Data perangkat berhasil diperbarui.');
    }

    /**
     * Hapus data perangkat.
     */
    public function destroy(Perangkat $perangkat)
    {
        $perangkat->delete();
        return redirect()->route('perangkat.index')->with('success', 'Data perangkat berhasil dihapus.');
    }
}
