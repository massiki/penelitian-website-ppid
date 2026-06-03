<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informations = Informasi::latest();
        if(request('cari')){
            $informations = $informations->where('nama', 'like', '%' . request('cari') . '%');
        }
        $informations = $informations->get();
        return view('admin.properties.informasi.index', compact('informations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.properties.informasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'url' => 'required',
        ], $this->feedback_validate);

        Informasi::create($validatedData);

        return redirect('/informasi')->with('success', 'Informasi baru telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Informasi $informasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Informasi $informasi)
    {
        return view('admin.properties.informasi.edit', [
            'item' => $informasi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Informasi $informasi)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'url' => 'required'
        ], $this->feedback_validate);

        $informasi->update($validatedData);

        return redirect('/informasi')->with('success', 'Informasi telah diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Informasi $informasi)
    {
        $informasi->delete();
        return redirect('/informasi')->with('success', 'Informasi telah dihapus!');
    }
}
