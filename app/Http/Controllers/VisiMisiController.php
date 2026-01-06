<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Get the single visi misi record (or create empty if none exists)
        $visiMisi = VisiMisi::first() ?? new VisiMisi();
        return view('admin.visi-misi.index', compact('visiMisi'));
    }

    public function edit()
    {
        $visiMisi = VisiMisi::first() ?? new VisiMisi();
        return view('admin.visi-misi.edit', compact('visiMisi'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'visi' => 'nullable|string|max:5000',
            'misi' => 'nullable|string|max:5000',
        ]);

        $visiMisi = VisiMisi::first() ?? new VisiMisi();
        $visiMisi->fill($validated);
        $visiMisi->save();

        return redirect()->route('admin.visi-misi.index')->with('success', 'Visi Misi berhasil disimpan.');
    }
}
