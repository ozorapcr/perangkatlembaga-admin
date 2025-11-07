<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    // ✅ Tampilkan semua warga
    public function index()
    {
        $warga = Warga::latest()->paginate(10);
        return view('pages.warga.index', [
            'warga' => $warga,
            'page' => 'warga' // 🔥 kirim ke layout
        ]);
    }

    // ✅ Form tambah warga
    public function create()
    {
        return view('pages.warga.create', ['page' => 'warga']);
    }

    // ✅ Simpan data warga baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'nullable|string|unique:warga,nik',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        Warga::create($request->all());
        return redirect()->route('pages.warga.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    // ✅ Form edit warga
    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('pages.warga.edit', [
            'warga' => $warga,
            'page' => 'warga' // 🔥 penting juga di sini
        ]);
    }

    // ✅ Update data warga
    public function update(Request $request, $id)
    {
        $warga = Warga::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'nullable|string|unique:warga,nik,' . $id,
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $warga->update($request->all());
        return redirect()->route('pages.warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    // ✅ Hapus data warga
    public function destroy($id)
    {
        Warga::destroy($id);
        return redirect()->route('pages.warga.index')->with('success', 'Data warga berhasil dihapus.');
    }
}
