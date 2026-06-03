<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Sosmed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = Berita::latest();
        if(request('cari')){
            $news = $news->where('judul', 'like', '%' . request('cari') . '%');
        }
        $news = $news->paginate(5);
        return view('admin.properties.berita.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.properties.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'required',
            'deskripsi_detail' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ], $this->feedback_validate);        

        $image = $request->file('image');
        $file_org =  $image->getClientOriginalName();
        $random_name = Str::random(5);
        $file_name = $random_name . '-' . $file_org;
        $file_path = $image->storeAs('image', $file_name, 'public');

        $berita = Berita::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'deskripsi_detail' => $request->deskripsi_detail,
            'url' => '',
            'image' => $file_path
        ]);

        $berita->url = '/berita/' . $berita->id;
        $berita->save();

        return redirect('/news')->with('success', 'Berita berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Berita $berita)
    {
        return view('admin.properties.berita.show', ['item' => $berita]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        return view('admin.properties.berita.edit', [
            'item' => $berita
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'required',
            'deskripsi_detail' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ], $this->feedback_validate);

        if ($request->image) {
            $image = $request->file('image');
            $file_org =  $image->getClientOriginalName();
            $random_name = Str::random(5);
            $file_name = $random_name . '-' . $file_org;
            $file_path = $image->storeAs('image', $file_name, 'public');
            Storage::disk('public')->delete($berita->image);
        } else {
            $file_path = $berita->image;
        }

        $berita->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'deskripsi_detail' => $request->deskripsi_detail,
            'url' => $berita->url,
            'image' => $file_path
        ]);

        return redirect('/news')->with('success', 'Berita berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        $file_name = $berita->image;
        if ($file_name && Storage::disk('public')->exists($file_name)) {
            Storage::disk('public')->delete($file_name);
        }
        $berita->delete();
        return redirect('/news')->with('success', 'Berita berhasil dihapus');
    }


    public function indexUser()
    {
        if (request('search')) {
            $berita = Berita::where('judul', 'like', '%' . request('search') . '%')->latest()->paginate(5);
        } else {
            $berita = Berita::latest()->paginate(5);
        }
        // dd($berita);
        $beritaPopular = Berita::orderBy('views', 'desc')->take(5)->get();
        $sosmed = Sosmed::all();
        return view('user.berita.index', [
            'sosmed' => $sosmed,
            'beritaPopular' => $beritaPopular,
            'berita' => $berita,
        ]);
    }


    public function detail(Berita $berita)
    {
        $berita->increment('views');
        $beritaPopular = Berita::orderBy('views', 'desc')->take(5)->get();
        $sosmed = Sosmed::all();
        return view('user.berita.show', [
            'item' => $berita,
            'sosmed' => $sosmed,
            'beritaPopular' => $beritaPopular,
        ]);
    }


    // public function search(Request $request)
    // {
    //     // dd($request);
    //     $searching = Berita::where('judul', 'like', '%' . request('search') . '%')->latest()->paginate(10);
    //     if ($searching->isEmpty()) {
    //         return redirect('/');
    //     }

    //     $beritaPopular = Berita::orderBy('views', 'desc')->take(5)->get();
    //     $sosmed = Sosmed::all();
    //     return view('user.berita.search', [
    //         'sosmed' => $sosmed,
    //         'beritaPopular' => $beritaPopular,
    //         'searching' => $searching
    //     ]);
    // }
}
