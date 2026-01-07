<?php
// app/Http/Controllers/AnggotaLembagaController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AnggotaLembaga;
use App\Models\JabatanLembaga;
use App\Models\Lembaga;
use App\Models\Warga;
use Illuminate\Http\Request;

class AnggotaLembagaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchableColumns = ['tgl_mulai', 'tgl_selesai'];
        $filterableColumns = ['lembaga_id', 'warga_id', 'jabatan_id', 'tgl_mulai', 'tgl_selesai'];

        $query = AnggotaLembaga::with(['lembaga', 'warga', 'jabatan']);

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('lembaga', function ($q) use ($request) {
                    $q->where('nama_lembaga', 'LIKE', '%' . $request->search . '%');
                })
                    ->orWhereHas('warga', function ($q) use ($request) {
                        $q->where('nama', 'LIKE', '%' . $request->search . '%');
                    })
                    ->orWhereHas('jabatan', function ($q) use ($request) {
                        $q->where('nama_jabatan', 'LIKE', '%' . $request->search . '%');
                    });
            });
        }

        // Filter lembaga
        if ($request->filled('lembaga_id')) {
            $query->where('lembaga_id', $request->lembaga_id);
        }

        // Filter jabatan
        if ($request->filled('jabatan_id')) {
            $query->where('jabatan_id', $request->jabatan_id);
        }

        // Filter status aktif
        if ($request->filled('status')) {
            if ($request->status === 'aktif') {
                $query->aktif();
            } elseif ($request->status === 'non_aktif') {
                $query->nonAktif();
            }
        }

        // Filter tanggal mulai
        if ($request->filled('tgl_mulai')) {
            $query->whereDate('tgl_mulai', $request->tgl_mulai);
        }

        $anggotaLembagas = $query->paginate(10);

                                    // GUNAKAN FULLY QUALIFIED CLASS NAME
        $lembagas = Lembaga::all(); // Tambahkan backslash di depan

        $wargas   = Warga::all();
        $jabatans = JabatanLembaga::all();

        return view('pages.anggota-lembaga.index', compact('anggotaLembagas', 'lembagas', 'wargas', 'jabatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
                                                    // GUNAKAN FULLY QUALIFIED CLASS NAME
        $lembagas = Lembaga::all(); // Tambahkan backslash di depan
        $wargas   = Warga::all();
        $jabatans = JabatanLembaga::all();

        return view('pages.anggota-lembaga.create', compact('lembagas', 'wargas', 'jabatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lembaga_id'  => 'required|exists:lembaga_desas,lembaga_id',
            'warga_id'    => 'required|exists:warga,id',
            'jabatan_id'  => 'required|exists:jabatan_lembagas,jabatan_id',
            'tgl_mulai'   => 'required|date',
            'tgl_selesai' => 'nullable|date|after:tgl_mulai',
        ]);

        // Cek apakah warga sudah menjadi anggota di lembaga yang sama dengan status aktif
        $anggotaAktif = AnggotaLembaga::where('warga_id', $validated['warga_id'])
            ->where('lembaga_id', $validated['lembaga_id'])
            ->aktif()
            ->exists();

        if ($anggotaAktif) {
            return back()
                ->withInput()
                ->withErrors(['warga_id' => 'Warga ini sudah menjadi anggota aktif di lembaga ini.']);
        }

        AnggotaLembaga::create($validated);

        return redirect()->route('anggota-lembaga.index')
            ->with('success', 'Anggota Lembaga berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AnggotaLembaga $anggotaLembaga)
    {
        $anggotaLembaga->load(['lembaga', 'warga', 'jabatan']);
        return view('anggota-lembaga.show', compact('anggotaLembaga'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnggotaLembaga $anggotaLembaga)
    {
                                                    // GUNAKAN FULLY QUALIFIED CLASS NAME
        $lembagas = Lembaga::all(); // Tambahkan backslash di depan
        $wargas   = Warga::all();
        $jabatans = JabatanLembaga::all();

        return view('pages.anggota-lembaga.edit', compact('anggotaLembaga', 'lembagas', 'wargas', 'jabatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnggotaLembaga $anggotaLembaga)
    {
        $validated = $request->validate([
            'lembaga_id'  => 'required|exists:lembaga_desas,lembaga_id',
            'warga_id'    => 'required|exists:warga,id',
            'jabatan_id'  => 'required|exists:jabatan_lembagas,jabatan_id',
            'tgl_mulai'   => 'required|date',
            'tgl_selesai' => 'nullable|date|after:tgl_mulai',
        ]);

        // Cek apakah warga sudah menjadi anggota di lembaga yang sama dengan status aktif
        // (kecuali untuk data yang sedang diedit)
        $anggotaAktif = AnggotaLembaga::where('warga_id', $validated['warga_id'])
            ->where('lembaga_id', $validated['lembaga_id'])
            ->where('anggota_id', '!=', $anggotaLembaga->anggota_id)
            ->aktif()
            ->exists();

        if ($anggotaAktif) {
            return back()
                ->withInput()
                ->withErrors(['warga_id' => 'Warga ini sudah menjadi anggota aktif di lembaga ini.']);
        }

        $anggotaLembaga->update($validated);

        return redirect()->route('anggota-lembaga.index')
            ->with('success', 'Anggota Lembaga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnggotaLembaga $anggotaLembaga)
    {
        $anggotaLembaga->delete();

        return redirect()->route('anggota-lembaga.index')
            ->with('success', 'Anggota Lembaga berhasil dihapus.');
    }
}
