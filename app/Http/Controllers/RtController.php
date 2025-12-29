<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use App\Models\Rw;
use Illuminate\Http\Request;

class RtController extends Controller
{
    /**
     * Menampilkan semua data RT
     */
    public function index(Request $request)
    {
        $filterableColumns = ['rw_id', 'nomor_rt', 'filter_ketua'];
        $searchableColumns = ['nomor_rt', 'keterangan'];
        
        // Query dengan filter dan search
        $query = Rt::with(['rw'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('rw_id')
            ->orderBy('nomor_rt');
            
        // Paginate hasil
        $rts = $query->paginate(10);
        
        // Ambil semua data RW untuk dropdown filter
        $rws = Rw::orderBy('nomorRw')->get();
        
        // Hitung statistik untuk ditampilkan
        $totalRT = Rt::count();
        $rtWithKetua = Rt::whereNotNull('ketua_rt_warga_id')->count();
        $rtWithoutKetua = Rt::whereNull('ketua_rt_warga_id')->count();
        $totalRW = Rw::count();
        
        return view('pages.rt.index', compact(
            'rts', 
            'rws', 
            'totalRT', 
            'rtWithKetua', 
            'rtWithoutKetua', 
            'totalRW'
        ));
    }
    
    /**
     * Menampilkan form tambah RT
     */
    public function create()
    {
        $rws = Rw::orderBy('nomorRw')->get();
        return view('rt.create', compact('rws'));
    }

    /**
     * Menyimpan data RT baru
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'rw_id' => 'required|exists:rws,id',
            'nomor_rt' => 'required|string|max:3',
            'ketua_rt_warga_id' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
        ]);

        // Cek apakah nomor RT sudah ada di RW yang sama
        $existing = Rt::where('rw_id', $validated['rw_id'])
            ->where('nomor_rt', $validated['nomor_rt'])
            ->first();
            
        if ($existing) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Nomor RT sudah ada di RW tersebut.');
        }

        // Simpan data
        Rt::create($validated);
        
        return redirect()->route('rt.index')
            ->with('success', 'Data RT berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail RT
     */
    public function show(Rt $rt)
    {
        $rt->load(['rw']);
        return view('rt.show', compact('rt'));
    }

    /**
     * Menampilkan form edit RT
     */
    public function edit(Rt $rt)
    {
        $rws = Rw::orderBy('nomorRw')->get();
        return view('rt.edit', compact('rt', 'rws'));
    }

    /**
     * Mengupdate data RT
     */
    public function update(Request $request, Rt $rt)
    {
        // Validasi input
        $validated = $request->validate([
            'rw_id' => 'required|exists:rws,id',
            'nomor_rt' => 'required|string|max:3',
            'ketua_rt_warga_id' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
        ]);

        // Cek duplikasi (kecuali data ini sendiri)
        $existing = Rt::where('rw_id', $validated['rw_id'])
            ->where('nomor_rt', $validated['nomor_rt'])
            ->where('rt_id', '!=', $rt->rt_id)
            ->first();
            
        if ($existing) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Nomor RT sudah ada di RW tersebut.');
        }

        // Update data
        $rt->update($validated);
        
        return redirect()->route('rt.index')
            ->with('success', 'Data RT berhasil diperbarui.');
    }

    /**
     * Menghapus data RT
     */
    public function destroy(Rt $rt)
    {
        $rt->delete();
        
        return redirect()->route('rt.index')
            ->with('success', 'Data RT berhasil dihapus.');
    }
}