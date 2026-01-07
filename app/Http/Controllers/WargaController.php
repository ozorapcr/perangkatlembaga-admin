<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    // =======================
    // INDEX (LIST WARGA)
    // =======================
    public function index(Request $request)
    {
        // Kolom yang bisa difilter
        $filterableColumns = ['alamat'];
        $searchableColumns = ['nama', 'nik', 'alamat', 'no_hp'];

        // Ambil data warga + filter + search
        $warga = Warga::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // 🔥 Statistik total warga
        $totalWarga = Warga::count();

        return view('pages.warga.index', [
            'warga'       => $warga,
            'totalWarga'  => $totalWarga,   // ⬅️ SEKARANG DIKIRIM KE BLADE
            'page'        => 'warga',
        ]);
    }

    // =======================
    // CREATE
    // =======================
    public function create()
    {
        return view('pages.warga.create', [
            'page' => 'warga'
        ]);
    }

    // =======================
    // STORE
    // =======================
    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'nik'    => 'nullable|string|unique:warga,nik',
            'no_hp'  => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        Warga::create($request->all());

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil ditambahkan.');
    }

    // =======================
    // EDIT
    // =======================
    public function edit($id)
    {
        $warga = Warga::findOrFail($id);

        return view('pages.warga.edit', [
            'warga' => $warga,
            'page'  => 'warga',
        ]);
    }

    // =======================
    // UPDATE
    // =======================
    public function update(Request $request, $id)
    {
        $warga = Warga::findOrFail($id);

        $request->validate([
            'nama'   => 'required|string|max:255',
            'nik'    => 'nullable|string|unique:warga,nik,' . $id,
            'no_hp'  => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $warga->update($request->all());

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil diperbarui.');
    }

    // =======================
    // DESTROY
    // =======================
    public function destroy($id)
    {
        Warga::destroy($id);

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil dihapus.');
    }
}
