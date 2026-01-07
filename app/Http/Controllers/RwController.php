<?php

namespace App\Http\Controllers;

use App\Models\Rw;
use App\Models\Warga;
use Illuminate\Http\Request;

class RwController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['nomorRw'];
        $searchableColumns = ['nomorRw', 'keterangan'];

        $rws = Rw::with('ketua')   // <-- relasi ketua warga
                ->filter($request, $filterableColumns)
                ->search($request, $searchableColumns)
                ->orderBy('nomorRw', 'asc')
                ->paginate(10)
                ->withQueryString();

        $totalRw = Rw::count();
        $rwWithKetua = Rw::whereNotNull('ketuaRwWargaId')->count();
        $rwWithoutKetua = Rw::whereNull('ketuaRwWargaId')->count();

        return view('pages.rw.index', compact(
            'rws',
            'totalRw',
            'rwWithKetua',
            'rwWithoutKetua'
        ));
    }

    public function create()
    {
        $wargas = Warga::orderBy('nama')->get();

        return view('pages.rw.create', compact('wargas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomorRw' => 'required|string|max:50|unique:rws,nomorRw',
            'ketuaRwWargaId' => 'nullable|exists:warga,id',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Rw::create($request->only('nomorRw','ketuaRwWargaId','keterangan'));

        return redirect()->route('rw.index')
            ->with('success', 'Data RW berhasil ditambahkan!');
    }

    public function show($id)
    {
        $rw = Rw::with('ketua')->findOrFail($id);

        return view('pages.rw.show', compact('rw'));
    }

    public function edit($id)
    {
        $rw = Rw::findOrFail($id);
        $wargas = Warga::orderBy('nama')->get();

        return view('pages.rw.edit', compact('rw','wargas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomorRw'   => 'required|string|max:50|unique:rws,nomorRw,' . $id,
            'ketuaRwWargaId' => 'nullable|exists:warga,id',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $rw = Rw::findOrFail($id);
        $rw->update($request->only('nomorRw','ketuaRwWargaId','keterangan'));

        return redirect()->route('rw.index')
            ->with('success', 'Data RW berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $rw = Rw::findOrFail($id);
        $rw->delete();

        return redirect()->route('rw.index')
            ->with('success', 'Data RW berhasil dihapus!');
    }
}
