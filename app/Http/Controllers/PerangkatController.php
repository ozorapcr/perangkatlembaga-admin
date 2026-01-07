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

    public function show($id)
    {
        $perangkat = Perangkat::with('warga')->findOrFail($id);

        return view('pages.perangkat.show', [
            'page' => 'perangkat',
            'perangkat' => $perangkat
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

        return view('pages.perangkat.create', compact('warga', 'jabatanOptions'))
            ->with('page','perangkat');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'warga_id' => 'required|exists:warga,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jabatan' => 'required|string|max:100',
            'nip' => 'nullable|string|max:50',
            'kontak' => 'nullable|string|max:20',
            'periode_mulai' => 'nullable|date',
            'periode_selesai' => 'nullable|date|after_or_equal:periode_mulai',
        ]);

        $perangkat = Perangkat::create($validated);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('perangkat-foto', 'public');
            $perangkat->update(['foto' => $path]);
        }

        return redirect()->route('perangkat.index')->with('success','Berhasil menambahkan perangkat');
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

        return view('pages.perangkat.edit', compact('perangkat','warga','jabatanOptions'))
            ->with('page','perangkat');
    }

    public function update(Request $request, $id)
    {
        $perangkat = Perangkat::findOrFail($id);

        $validated = $request->validate([
            'warga_id' => 'required|exists:warga,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jabatan' => 'required|string|max:100',
            'nip' => 'nullable|string|max:50',
            'kontak' => 'nullable|string|max:20',
            'periode_mulai' => 'nullable|date',
            'periode_selesai' => 'nullable|date|after_or_equal:periode_mulai',
        ]);

        $perangkat->update($validated);

        if ($request->hasFile('foto')) {

            if ($perangkat->foto && Storage::disk('public')->exists($perangkat->foto)) {
                Storage::disk('public')->delete($perangkat->foto);
            }

            $path = $request->file('foto')->store('perangkat-foto', 'public');
            $perangkat->update(['foto' => $path]);
        }

        return redirect()->route('perangkat.index')->with('success','Data perangkat berhasil diperbarui');
    }

    public function destroy($id)
    {
        $perangkat = Perangkat::findOrFail($id);

        if ($perangkat->foto && Storage::disk('public')->exists($perangkat->foto)) {
            Storage::disk('public')->delete($perangkat->foto);
        }

        $perangkat->delete();

        return redirect()->route('perangkat.index')->with('success','Data perangkat berhasil dihapus');
    }
}
