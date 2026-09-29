<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meja;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mejas = Meja::orderBy('idmeja')->get();
        return view('meja.index', compact('mejas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('meja.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'namameja' => 'required|string|max:10',
            'status' => 'required|in:kosong,terisi',
        ]);

        Meja::create($data);
        return redirect()->route('meja.index')->with('success', 'Meja berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meja $meja)
    {
        return view('meja.edit', compact('meja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meja $meja)
    {
        $data = $request->validate([
            'namameja' => 'required|string|max:10',
            'status' => 'required|in:kosong,terisi',
        ]);

        $meja->update($data);
        return redirect()->route('meja.index')->with('success', 'Meja berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meja $meja)
    {
        $meja->delete();
        return redirect()->route('meja.index')->with('success', 'Meja berhasil dihapus.');
    }
}
