<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use Illuminate\Http\Request;

class LembagaController extends Controller
{
    /**
     * Menampilkan semua data Lembaga Desa
     */
    public function index(Request $request)
    {
        $filterableColumns = ['nama_lembaga', 'filter_kontak'];
        $searchableColumns = ['nama_lembaga', 'deskripsi', 'kontak'];
        
        // Query dengan filter dan search
        $query = Lembaga::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('nama_lembaga');
            
        // Paginate hasil
        $lembagaDesas = $query->paginate(10);
        
        return view('pages.lembaga.index', compact('lembagaDesas'));
    }

    /**
     * Menampilkan form tambah Lembaga Desa
     */
    public function create()
    {
        return view('pages.lembaga.create');
    }

    /**
     * Menyimpan data Lembaga Desa baru
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_lembaga' => 'required|string|max:100|unique:lembaga_desas,nama_lembaga',
            'deskripsi' => 'nullable|string',
            'kontak' => 'nullable|string|max:50',
        ]);

        // Simpan data
        Lembaga::create($validated);
        
        return redirect()->route('lembaga.index')
            ->with('success', 'Data Lembaga Desa berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail Lembaga Desa
     */
    public function show(Lembaga $lembaga)
    {
        $lembaga->load(['perangkats' => function($query) {
            $query->with('warga')->orderBy('jabatan');
        }]);
        
        return view('pages.lembaga.show', compact('lembaga'));
    }

    /**
     * Menampilkan form edit Lembaga Desa
     */
    public function edit(Lembaga $lembaga)
    {
        return view('pages.lembaga.edit', compact('lembaga'));
    }

    /**
     * Mengupdate data Lembaga Desa
     */
    public function update(Request $request, Lembaga $lembaga)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_lembaga' => 'required|string|max:100|unique:lembaga_desas,nama_lembaga,' . $lembaga->lembaga_id . ',lembaga_id',
            'deskripsi' => 'nullable|string',
            'kontak' => 'nullable|string|max:50',
        ]);

        // Update data
        $lembaga->update($validated);
        
        return redirect()->route('lembaga.index')
            ->with('success', 'Data Lembaga Desa berhasil diperbarui.');
    }

    /**
     * Menghapus data Lembaga Desa
     */
    public function destroy(Lembaga $lembaga)
    {
        // Cek apakah lembaga memiliki perangkat
        if ($lembaga->perangkats()->exists()) {
            return redirect()->route('lembaga.index')
                ->with('error', 'Tidak dapat menghapus lembaga yang masih memiliki perangkat.');
        }
        
        $lembaga->delete();
        
        return redirect()->route('lembaga.index')
            ->with('success', 'Data Lembaga Desa berhasil dihapus.');
    }
}