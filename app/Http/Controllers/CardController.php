<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = Card::latest();
        if(request('cari')){
            $cards = $cards->where('judul', 'like', '%' . request('cari') . '%');
        }
        $cards = $cards->get();
        return view('admin.properties.cards.index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.properties.cards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'judul' => 'required|max:255',
            'deskripsi' => 'required',
            'url' => 'required|max:255',
        ], $this->feedback_validate);

        $icon = $request->file('icon');
        $file_org =  $icon->getClientOriginalName();
        $random_name = Str::random(5);
        $file_name = $random_name . '-' . $file_org;
        $file_path = $icon->storeAs('icons', $file_name, 'public');

        Card::create(array_merge($request->except('icon'), ['icon' => $file_path]));

        // Card::create([
        //     'icon' => $file_path,
        //     'judul' => $request->judul,
        //     'deskripsi' => $request->deskripsi,
        //     'url' => $request->url,
        // ]);

        return redirect('/cards')->with('success', 'Card berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Card $card)
    {
        return view('admin.properties.cards.edit', [
            'item' => $card
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Card $card)
    {
        $request->validate([
            'icon' => 'image|mimes:jpg,jpeg,png|max:2048',
            'judul' => 'required|max:255',
            'deskripsi' => 'required',
            'url' => 'required|max:255',
        ], $this->feedback_validate);

        if ($request->icon) {
            $icon = $request->file('icon');
            $file_org =  $icon->getClientOriginalName();
            $random_name = Str::random(5);
            $file_name = $random_name . '-' . $file_org;
            $file_path = $icon->storeAs('icons', $file_name, 'public');
            Storage::disk('public')->delete($card->icon);
        } else {
            $file_path = $card->icon;
        }

        $card->update(array_merge($request->except('icon'), ['icon' => $file_path]));

        return redirect('/cards')->with('success', 'Card berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        $file_name = $card->icon;
        if ($file_name && Storage::disk('public')->exists($file_name)) {
            Storage::disk('public')->delete($file_name);
        }
        $card->delete();
        return redirect('/cards')->with('success', 'Card berhasil dihapus!');
    }
}
