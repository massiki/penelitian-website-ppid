<?php

namespace App\Http\Controllers;

use App\Models\Sosmed;
use Illuminate\Http\Request;

class SosmedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sosmeds = Sosmed::latest();
        if(request('cari')){
            $sosmeds = $sosmeds->where('nama', 'like', '%' . request('cari') . '%');
        }
        $sosmeds = $sosmeds->get();
        return view('admin.properties.sosmed.index', compact('sosmeds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.properties.sosmed.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'link' => 'required|url',
        'icon' => 'required',
    ], $this->feedback_validate);

    Sosmed::create($validatedData);

    return redirect('/sosmed')->with('success', 'Sosial media baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(sosmed $sosmed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sosmed $sosmed)
    {
        return view('admin.properties.sosmed.edit', [
            'item' => $sosmed
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, sosmed $sosmed)
    {
    $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'link' => 'required|url',
        'icon' => 'required',
    ], $this->feedback_validate);

    $sosmed->update($validatedData);

    return redirect('/sosmed')->with('success', 'Sosial media berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sosmed $sosmed)
    {
        $sosmed->delete();
        return redirect('/sosmed')->with('success', 'Sosial media berhasil dihapus!');
    }
}
