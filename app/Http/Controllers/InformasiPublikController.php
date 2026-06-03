<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformasiPublik;
use App\Models\InformasiPublikDetail;
use App\Models\KategoriInformasi;
use App\Models\Reference;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class InformasiPublikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $information_public = InformasiPublik::latest();
        if (request('cari')) {
            $information_public = $information_public->where('ringkasan_informasi', 'like', '%' . request('cari') . '%');
        }
        $information_public = $information_public->paginate(5);
        return view('admin.menuUtama.informasiPublik.index', compact('information_public'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Reference::where('slug', 'informasi')->get();
        $storages = Reference::where('slug', 'penyimpanan')->get();
        return view('admin.menuUtama.informasiPublik.create', compact(['categories', 'storages']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'ringkasan_informasi' => 'required',
            'pejabat_penguasa_informasi' => 'required|max:255',
            'penanggung_jawab_informasi' => 'required|max:255',
            'bentuk_informasi_cetak' => 'required|max:255',
            'bentuk_informasi_digital' => 'required|max:255',
            'waktu_penyimpanan_id' => 'required',
            'kategori_informasi_id' => 'required',
        ], $this->feedback_validate );

        InformasiPublik::create($request->all());

        return redirect('/informasi_publik')->with('success', 'Informasi publik berhasil dibuat');
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
    public function edit(InformasiPublik $informasiPublik)
    {
        $categories = Reference::where('slug', 'informasi')->get();
        $storages = Reference::where('slug', 'penyimpanan')->get();
        return view('admin.menuUtama.informasiPublik.edit', compact(['informasiPublik','categories', 'storages']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InformasiPublik $informasiPublik)
    {
        $request->validate([
            'ringkasan_informasi' => 'required',
            'pejabat_penguasa_informasi' => 'required|max:255',
            'penanggung_jawab_informasi' => 'required|max:255',
            'bentuk_informasi_cetak' => 'required|max:255',
            'bentuk_informasi_digital' => 'required|max:255',
            'waktu_penyimpanan_id' => 'required',
            'kategori_informasi_id' => 'required',
        ], $this->feedback_validate );

        $informasiPublik->update($request->all());

        return redirect('/informasi_publik')->with('success', 'Informasi publik berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InformasiPublik $informasiPublik)
    {
        if($informasiPublik->infopubdet->count() > 0){
            return redirect('/informasi_publik')->with('failed', 'Tidak bisa dihapus, karena masih ada informasi publik detail');
        } else {
            $informasiPublik->delete();
        return redirect('/informasi_publik')->with('success', 'Data berhasil dihapus');
        }
    }


    public function information(string $slug, string $number)
    {
        $reference = Reference::where('slug', $slug)->where('number', $number)->first();
        if (!$reference) {
            return redirect()->back();
        }
        
        $informations = InformasiPublik::where('kategori_informasi_id', $reference->id)->latest()->paginate(10);
        return view('user.informasipublik.index', compact('informations', 'slug'));
    }

    public function detail(string $id)
    {
        $information = InformasiPublik::find($id);
        $details = InformasiPublikDetail::where('informasi_publik_id', $id)->latest()->paginate(10);
        return view('user.informasipublik.detail', compact(['details', 'information']));
    }
}
