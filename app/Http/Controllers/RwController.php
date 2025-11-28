<?php

namespace App\Http\Controllers;

use App\Models\Rw;
use Illuminate\Http\Request;

class RwController extends Controller
{
    /**
     * Menampilkan semua data RW dengan pagination, filter, dan search
     */
    public function index(Request $request)
    {
        // Kolom yang bisa di-filter
        $filterableColumns = ['nomorRw'];
        
        // Kolom yang bisa di-search
        $searchableColumns = ['nomorRw', 'keterangan'];

        // Query data dengan filter, search, dan pagination
        $rws = Rw::filter($request, $filterableColumns)
                ->search($request, $searchableColumns)
                ->orderBy('nomorRw', 'asc')
                ->paginate(10)
                ->withQueryString();

        return view('pages.rw.index', compact('rws'));
    }

    /**
     * Menampilkan form tambah data RW
     */
    public function create()
    {
        return view('pages.rw.create');
    }

    /**
     * Menyimpan data RW baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomorRw' => 'required|string|max:50|unique:rws,nomorRw',
            'ketuaRwWargaId' => 'nullable|numeric',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Rw::create([
            'nomorRw' => $request->nomorRw,
            'ketuaRwWargaId' => $request->ketuaRwWargaId,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('rw.index')
            ->with('success', 'Data RW berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail RW tertentu
     */
    public function show($id)
    {
        $rw = Rw::findOrFail($id);
        return view('pages.rw.show', compact('rw'));
    }

    /**
     * Menampilkan form edit data RW
     */
    public function edit($id)
    {
        $rw = Rw::findOrFail($id);
        return view('pages.rw.edit', compact('rw'));
    }

    /**
     * Mengupdate data RW
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomorRw' => 'required|string|max:50|unique:rws,nomorRw,' . $id,
            'ketuaRwWargaId' => 'nullable|numeric',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $rw = Rw::findOrFail($id);
        $rw->update([
            'nomorRw' => $request->nomorRw,
            'ketuaRwWargaId' => $request->ketuaRwWargaId,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('rw.index')
            ->with('success', 'Data RW berhasil diperbarui!');
    }

    /**
     * Menghapus data RW
     */
    public function destroy($id)
    {
        $rw = Rw::findOrFail($id);
        $rw->delete();

        return redirect()->route('rw.index')
            ->with('success', 'Data RW berhasil dihapus!');
    }
}