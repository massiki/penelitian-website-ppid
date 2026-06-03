<?php

namespace App\Http\Controllers;

use App\Models\InfoBanner;
use Illuminate\Http\Request;

class InfoBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infoBanners = InfoBanner::latest()->get();
        return view('admin.properties.infoBanners.index', compact('infoBanners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.properties.infoBanners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'url' => 'required',
            'nama_button' => 'required'
        ], $this->feedback_validate);

        InfoBanner::create($request->all());

        return redirect('/info_banners')->with('success', 'Informasi Banner berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(InfoBanner $infoBanner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InfoBanner $infoBanner)
    {
        return view('admin.properties.infoBanners.edit', [
            'item' => $infoBanner
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InfoBanner $infoBanner)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'url' => 'required',
            'nama_button' => 'required'
        ], $this->feedback_validate);
        $infoBanner->update($request->all());
        return redirect('/info_banners')->with('success', 'Informasi Banner berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InfoBanner $infoBanner)
    {
        $infoBanner->delete();
        return redirect('/info_banners')->with('success', 'Informasi Banner berhasil dihapus.');
    }
}
