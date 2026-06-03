<?php

namespace App\Http\Controllers;

use App\Models\Reference;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $references = Reference::latest()->get();
        $memperoleh = $references->where('slug', 'memperoleh');
        $pengajuan = $references->where('slug', 'pengajuan');
        $informasi = $references->where('slug', 'informasi');
        return view('admin.properties.references.index', compact('memperoleh', 'pengajuan', 'informasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $slug)
    {
        return view('admin.properties.references.create', compact('slug'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $count = Reference::where('slug', $request->slug)->count();
        
        $request->validate([
            'nama' => 'required|max:255',
            'slug' => 'required|max:255'
        ], $this->feedback_validate);

        Reference::create([
            'nama' => $request->nama,
            'slug' => $request->slug,
            'number' => $count + 1,
        ]);

        return redirect('/references')->with('success', 'Data ' . $request->slug . ' berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reference $reference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug, Reference $reference)
    {
        return view('admin.properties.references.edit', [
            'item' => $reference
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reference $reference)
    {
    $request->validate([
        'nama' => 'required|max:255',
    ], $this->feedback_validate);

    $reference->update([
        'nama' => $request->nama,
        'slug' => $reference->slug,
        'number' => $reference->number,
    ]);

    return redirect('/references')->with('success', 'Data ' . $reference->slug . ' berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reference $reference)
    {
        if($reference->slug == 'memperoleh'){
            $dataReference = $reference->pemohon();
        }elseif($reference->slug == 'pengajuan'){
            $dataReference = $reference->pengaju();
        }elseif($reference->slug == 'informasi'){
            $dataReference = $reference->informasi();
        }

        if($dataReference->count() > 0){
            return redirect('/references')->with('failed', 'Tidak bisa dihapus, data masih terhubung dengan tabel lain');
        } else {
            $reference->delete();
            return redirect('/references')->with('success', 'Data '. $reference->slug . ' berhasil dihapus');
        }
    }
}
