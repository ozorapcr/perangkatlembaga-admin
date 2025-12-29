<?php

namespace App\Http\Controllers;

use App\Models\Perangkat;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PerangkatController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['jabatan'];
        $searchableColumns = ['jabatan', 'nip', 'kontak'];

        $data = Perangkat::with('warga')
                    ->filter($request, $filterableColumns)
                    ->search($request, $searchableColumns)
                    ->get();

        return view('pages.perangkat.index', [
            'page' => 'perangkat',
            'data' => $data,
        ]);
    }

    public function create()
    {
        $warga = Warga::all();

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'warga_id' => 'required|exists:warga,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jabatan' => 'required|string|max:100|in:Kepala Desa,Sekretaris Desa,Bendahara Desa,Kasi Pemerintahan,Kasi Kesejahteraan,
                          Kasi Pelayanan,Kadus,Staf',
            'nip' => 'nullable|string|max:50',
            'kontak' => 'nullable|string|max:20',
            'periode_mulai' => 'nullable|date',
            'periode_selesai' => 'nullable|date|after_or_equal:periode_mulai',
        ]);

        // Simpan perangkat (tanpa file path dulu)
        $perangkat = Perangkat::create(array_diff_key($validated, array_flip(['foto'])));

        // Jika ada file, simpan ke storage
        if ($request->hasFile('foto')) {
            try {
                // Pastikan direktori 'perangkat-foto' ada di disk public
                if (!Storage::disk('public')->exists('perangkat-foto')) {
                    Storage::disk('public')->makeDirectory('perangkat-foto');
                }

                $fotoPath = $request->file('foto')->store('perangkat-foto', 'public');

                // Simpan path ke kolom foto (pastikan tabel perangkat punya kolom 'foto')
                $perangkat->foto = $fotoPath;
                $perangkat->save();
            } catch (\Throwable $e) {
                Log::error('Gagal upload foto perangkat: ' . $e->getMessage());
                // Jika terjadi error I/O, kembalikan dengan pesan jelas
                return redirect()->route('perangkat.index')
                    ->with('error', 'Gagal menyimpan foto. Periksa permission folder storage dan coba lagi.');
            }
        }

        return redirect()
            ->route('perangkat.index')
            ->with('success', 'Data perangkat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $perangkat = Perangkat::findOrFail($id);
        $warga = Warga::all();

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

        // Update data selain foto terlebih dahulu
        $perangkat->update(array_diff_key($validated, array_flip(['foto'])));

        // Jika upload foto baru
        if ($request->hasFile('foto')) {
            try {
                // Pastikan direktori ada
                if (!Storage::disk('public')->exists('perangkat-foto')) {
                    Storage::disk('public')->makeDirectory('perangkat-foto');
                }

                // Hapus foto lama bila ada
                if ($perangkat->foto && Storage::disk('public')->exists($perangkat->foto)) {
                    Storage::disk('public')->delete($perangkat->foto);
                }

                // Simpan foto baru
                $fotoPath = $request->file('foto')->store('perangkat-foto', 'public');
                $perangkat->foto = $fotoPath;
                $perangkat->save();
            } catch (\Throwable $e) {
                Log::error('Gagal upload/update foto perangkat: ' . $e->getMessage());
                return redirect()->route('perangkat.edit', $perangkat->id)
                    ->with('error', 'Gagal menyimpan foto baru. Periksa permission folder storage dan coba lagi.');
            }
        }

        return redirect()
            ->route('perangkat.index')
            ->with('success', 'Data perangkat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $perangkat = Perangkat::findOrFail($id);

        try {
            // Hapus foto jika ada
            if ($perangkat->foto && Storage::disk('public')->exists($perangkat->foto)) {
                Storage::disk('public')->delete($perangkat->foto);
            }
        } catch (\Throwable $e) {
            Log::warning('Gagal menghapus file foto saat destroy perangkat: ' . $e->getMessage());
            // tetap lanjutkan hapus data record walau file gagal dihapus
        }

        $perangkat->delete();

        return redirect()
            ->route('perangkat.index')
            ->with('success', 'Data perangkat berhasil dihapus.');
    }
}
