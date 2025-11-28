<?php

namespace App\Http\Controllers;

use App\Models\Perangkat;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerangkatController extends Controller
{
    /**
     * 🔹 Tampilkan semua data perangkat desa dengan filter
     */
    public function index(Request $request)
    {
        // Daftar kolom yang bisa difilter sesuai name pada form
        $filterableColumns = ['jabatan'];
        $searchableColumns = ['jabatan', 'nip', 'kontak'];
    
        // Gunakan scope filter dan search
        $data = Perangkat::with('warga')
                    ->filter($request, $filterableColumns)
                    ->search($request, $searchableColumns)
                    ->get();

        return view('pages.perangkat.index', [
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
        
        // Daftar pilihan jabatan
        $jabatanOptions = [
            'Kepala Desa',
            'Sekretaris Desa',
            'Bendahara Desa',
            'Kasi Pemerintahan',
            'Kasi Kesejahteraan',
            'Kasi Pelayanan',
            'Kadus',
            'Staf'
        ];

        return view('pages.perangkat.create', [
            'page' => 'perangkat',
            'warga' => $warga,
            'jabatanOptions' => $jabatanOptions,
        ]);
    }

    /**
     * 🔹 Simpan data perangkat baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'warga_id' => 'required|exists:warga,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jabatan' => 'required|string|max:100|in:Kepala Desa,Sekretaris Desa,Bendahara Desa,Kasi Pemerintahan,Kasi Kesejahteraan,Kasi Pelayanan,Kadus,Staf',
            'nip' => 'nullable|string|max:50',
            'kontak' => 'nullable|string|max:20',
            'periode_mulai' => 'nullable|date',
            'periode_selesai' => 'nullable|date|after_or_equal:periode_mulai',
        ]);

        // ✅ PERBAIKI: Handle upload foto
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('perangkat-foto', 'public');
            $validated['foto'] = $fotoPath;
        }

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
        
        // Daftar pilihan jabatan
        $jabatanOptions = [
            'Kepala Desa',
            'Sekretaris Desa',
            'Bendahara Desa',
            'Kasi Pemerintahan',
            'Kasi Kesejahteraan',
            'Kasi Pelayanan',
            'Kadus',
            'Staf'
        ];

        return view('pages.perangkat.edit', [
            'page' => 'perangkat',
            'perangkat' => $perangkat,
            'warga' => $warga,
            'jabatanOptions' => $jabatanOptions,
        ]);
    }

    /**
     * 🔹 Update data perangkat yang sudah ada
     */
    public function update(Request $request, $id)
    {
        $perangkat = Perangkat::findOrFail($id);

        $validated = $request->validate([
            'warga_id' => 'required|exists:warga,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jabatan' => 'required|string|max:100|in:Kepala Desa,Sekretaris Desa,Bendahara Desa,Kasi Pemerintahan,Kasi Kesejahteraan,Kasi Pelayanan,Kadus,Staf',
            'nip' => 'nullable|string|max:50',
            'kontak' => 'nullable|string|max:20',
            'periode_mulai' => 'nullable|date',
            'periode_selesai' => 'nullable|date|after_or_equal:periode_mulai',
        ]);

        // ✅ PERBAIKI: Handle upload foto - FIX ALL TYPOS
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($perangkat->foto && Storage::disk('public')->exists($perangkat->foto)) {
                Storage::disk('public')->delete($perangkat->foto);
            }
            
            // ✅ PERBAIKI: 'foto' bukan 'foto_perangkat', dan store() bukan storage()
            $fotoPath = $request->file('foto')->store('perangkat-foto', 'public');
            $validated['foto'] = $fotoPath;
        }

        $perangkat->update($validated);

        return redirect()
            ->route('perangkat.index')
            ->with('success', 'Data perangkat berhasil diperbarui.');
    }

    /**
     * 🔹 Hapus data perangkat
     */
    public function destroy($id)
    {
        $perangkat = Perangkat::findOrFail($id);
        
        // Hapus foto jika ada
        if ($perangkat->foto && Storage::disk('public')->exists($perangkat->foto)) {
            Storage::disk('public')->delete($perangkat->foto);
        }
        
        $perangkat->delete();

        return redirect()
            ->route('perangkat.index')
            ->with('success', 'Data perangkat berhasil dihapus.');
    }
}