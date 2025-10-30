<?php

namespace App\Http\Controllers;

use App\Models\Perangkat;
use App\Models\Warga;
use Illuminate\Http\Request;

class PerangkatController extends Controller
{
    /**
     * 🔹 Tampilkan semua data perangkat desa
     */
    public function index()
    {
        $data = Perangkat::with('warga')->get();

        return view('perangkat.index', [
            'page' => 'perangkat',
            'data' => $data,
        ]);
    }

    /**
     * 🔹 Tampilkan form tambah perangkat baru
     */
    public function create()
    {
        $warga = Warga::all();

        return view('perangkat.create', [
            'page' => 'perangkat',
            'warga' => $warga,
        ]);
    }

    /**
     * 🔹 Simpan data perangkat baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'warga_id' => 'required|exists:warga,id', // ✅ diperbaiki dari "wargas" ke "warga"
            'jabatan' => 'required|string|max:100',
            'nip' => 'nullable|string|max:50',
            'kontak' => 'nullable|string|max:20',
            'periode_mulai' => 'nullable|date',
            'periode_selesai' => 'nullable|date|after_or_equal:periode_mulai',
        ]);

        Perangkat::create($validated);

        return redirect()
            ->route('perangkat.index')
            ->with('success', 'Data perangkat berhasil ditambahkan.');
    }

    /**
     * 🔹 Tampilkan form edit perangkat berdasarkan ID
     */
    public function edit($id)
    {
        $perangkat = Perangkat::findOrFail($id);
        $warga = Warga::all();

        return view('perangkat.edit', [
            'page' => 'perangkat',
            'perangkat' => $perangkat,
            'warga' => $warga,
        ]);
    }

    /**
     * 🔹 Update data perangkat yang sudah ada
     */
    public function update(Request $request, $id)
    {
        $perangkat = Perangkat::findOrFail($id);

        $validated = $request->validate([
            'warga_id' => 'required|exists:warga,id', // ✅ diperbaiki juga di sini
            'jabatan' => 'required|string|max:100',
            'nip' => 'nullable|string|max:50',
            'kontak' => 'nullable|string|max:20',
            'periode_mulai' => 'nullable|date',
            'periode_selesai' => 'nullable|date|after_or_equal:periode_mulai',
        ]);

        $perangkat->update($validated);

        return redirect()
            ->route('perangkat.index')
            ->with('success', 'Data perangkat berhasil diperbarui.');
    }

    /**
     * 🔹 Hapus data perangkat berdasarkan ID
     */
    public function destroy($id)
    {
        $perangkat = Perangkat::findOrFail($id);
        $perangkat->delete();

        return redirect()
            ->route('perangkat.index')
            ->with('success', 'Data perangkat berhasil dihapus.');
    }
}
