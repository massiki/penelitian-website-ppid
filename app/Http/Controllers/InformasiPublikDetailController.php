<?php

namespace App\Http\Controllers;

use App\Models\InformasiPublik;
use App\Models\InformasiPublikDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InformasiPublikDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $informasiPublikId)
    {
        $details = InformasiPublikDetail::where('informasi_publik_id', $informasiPublikId)
            ->when(request('cari'), function ($query) {
                $query->where('informasi', 'like', '%' . request('cari') . '%');
            })->latest()->paginate(10);

        $infoPublik = InformasiPublik::select('ringkasan_informasi')->where('id', $informasiPublikId)->first();
        return view('admin.menuUtama.informasiPublik.informasiPublikDetail.index', compact('details', 'informasiPublikId', 'infoPublik'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $informasiPublikId)
    {
        return view('admin.menuUtama.informasiPublik.informasiPublikDetail.create', compact('informasiPublikId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'informasi' => 'required',
            'tahun' => 'required|numeric',
            'informasi_publik_id' => 'required|max:255',
            'link' => 'required|file|mimes:jpg,png,jpeg,pdf|max:2048',
        ], $this->feedback_validate );

        $link = $request->file('link');
        $file_org =  $link->getClientOriginalName();
        $random_name = Str::random(5);
        $file_name = $random_name . '-' . $file_org;
        $file_path = $link->storeAs('pdf', $file_name, 'public');

        InformasiPublikDetail::create(array_merge($request->except('link'), ['link' => $file_path]));

        return redirect('/informasi_publik/' . $request->informasi_publik_id . '/detail')->with('success', 'Informasi publik detail berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(InformasiPublikDetail $informasiPublikDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $informasiPublikId, InformasiPublikDetail $informasiPublikDetail)
    {
        return view('admin.menuUtama.informasiPublik.informasiPublikDetail.edit', compact('informasiPublikId','informasiPublikDetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InformasiPublikDetail $informasiPublikDetail)
    {
        $request->validate([
            'informasi' => 'required',
            'tahun' => 'required|numeric',
            'informasi_publik_id' => 'required|max:255',
            'link' => 'file|mimes:jpg,png,jpeg,pdf|max:2048',
        ], $this->feedback_validate );

        if ($request->link) {
            $link = $request->file('link');
            $file_org =  $link->getClientOriginalName();
            $random_name = Str::random(5);
            $file_name = $random_name . '-' . $file_org;
            $file_path = $link->storeAs('pdf', $file_name, 'public');
            Storage::disk('public')->delete($informasiPublikDetail->link);
        } else {
            $file_path = $informasiPublikDetail->link;
        }

        $informasiPublikDetail->update(array_merge($request->except('link'), ['link' => $file_path]));

        return redirect('/informasi_publik/' . $request->informasi_publik_id . '/detail')->with('success', 'Informasi publik detail berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InformasiPublikDetail $informasiPublikDetail)
    {
        $id = $informasiPublikDetail->informasi_publik_id;
        $file_name = $informasiPublikDetail->link;
        if ($file_name && Storage::disk('public')->exists($file_name)) {
            Storage::disk('public')->delete($file_name);
        }
        $informasiPublikDetail->delete();
        return redirect('/informasi_publik/' . $id . '/detail')->with('success', 'Data berhasil dihapus');
    }
}
