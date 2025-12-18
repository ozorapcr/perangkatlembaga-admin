<?php
// app/Http/Controllers/JabatanLembagaController.php

namespace App\Http\Controllers;

use App\Models\JabatanLembaga;
use App\Models\Lembaga;
use Illuminate\Http\Request;

class JabatanLembagaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchableColumns = ['nama_jabatan', 'level'];
        $filterableColumns = ['nama_jabatan', 'level', 'lembaga_id'];

        $query = JabatanLembaga::with('lembaga');

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request, $searchableColumns) {
                foreach ($searchableColumns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }

        // Filter
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, 'LIKE', '%' . $request->input($column) . '%');
            }
        }

        $jabatanLembagas = $query->paginate(10);
        $lembagas = Lembaga::all();

        return view('pages.jabatan.index', compact('jabatanLembagas', 'lembagas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lembagas = Lembaga::all();
        return view('pages.jabatan.create', compact('lembagas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lembaga_id' => 'required|exists:lembaga_desas,lembaga_id',
            'nama_jabatan' => 'required|string|max:255',
            'level' => 'required|integer',
        ]);

        JabatanLembaga::create($validated);

        return redirect()->route('jabatan.index')
                         ->with('success', 'Jabatan Lembaga berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(JabatanLembaga $jabatanLembaga)
    {
        return view('pages.jabatan.show', compact('jabatanLembaga'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JabatanLembaga $jabatanLembaga)
    {
        $lembagas = Lembaga::all();
        return view('pages.jabatan.edit', compact('jabatanLembaga', 'lembagas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JabatanLembaga $jabatanLembaga)
    {
        $validated = $request->validate([
            'lembaga_id' => 'required|exists:lembaga_desas,lembaga_id',
            'nama_jabatan' => 'required|string|max:255',
            'level' => 'required|integer',
        ]);

        $jabatanLembaga->update($validated);

        return redirect()->route('jabatan.index')
                         ->with('success', 'Jabatan Lembaga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JabatanLembaga $jabatanLembaga)
    {
        $jabatanLembaga->delete();

        return redirect()->route('jabatan.index')
                         ->with('success', 'Jabatan Lembaga berhasil dihapus.');
    }
}