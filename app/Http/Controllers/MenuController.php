<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request('cari')) {
            $menus = Menu::latest()->where('nama', 'like', '%' . request('cari') . '%')->get();
        } else {
            $menus = Menu::latest()->get();
        }

        return view('admin.properties.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.properties.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'url' => 'nullable|max:255',
        ],$this->feedback_validate);

        Menu::create($request->all());

        return redirect('/menu')->with('success', 'Menu Berhasil Dibuat.');
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
    public function edit(Menu $menu)
    {
        return view('admin.properties.menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'url' => 'nullable|max:255',
        ],$this->feedback_validate);

        $menu->update($request->all());

        return redirect('/menu')->with('success', 'Menu Berhasil Diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        if($menu->child->count() > 0){
            return redirect('/menu')->with('failed', 'Tidak bisa dihapus, karena masih ada submenu');
        } else {
            $menu->delete();
            return redirect('/menu')->with('success', 'Data berhasil dihapus');
        }
    }
}
