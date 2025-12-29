<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function index()
    {
        $developers = Developer::all();
        return view('developers.index', compact('developers'));
    }

    public function show($id)
    {
        $developer = Developer::findOrFail($id);
        return view('developers.show', compact('developer'));
    }

    public function create()
    {
        return view('developers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|unique:developers',
            'prodi' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'linkedin_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
        ]);

        $data = $request->except('photo');
        
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('developers', 'public');
            $data['photo_path'] = $path;
        }

        Developer::create($data);

        return redirect()->route('developers.index')
            ->with('success', 'Data developer berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $developer = Developer::findOrFail($id);
        return view('developers.edit', compact('developer'));
    }

    public function update(Request $request, $id)
    {
        $developer = Developer::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|unique:developers,nim,' . $id,
            'prodi' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'linkedin_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
        ]);

        $data = $request->except('photo');
        
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($developer->photo_path) {
                \Storage::disk('public')->delete($developer->photo_path);
            }
            
            $path = $request->file('photo')->store('developers', 'public');
            $data['photo_path'] = $path;
        }

        $developer->update($data);

        return redirect()->route('developers.show', $id)
            ->with('success', 'Data developer berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $developer = Developer::findOrFail($id);
        
        if ($developer->photo_path) {
            \Storage::disk('public')->delete($developer->photo_path);
        }
        
        $developer->delete();

        return redirect()->route('developers.index')
            ->with('success', 'Data developer berhasil dihapus.');
    }
}