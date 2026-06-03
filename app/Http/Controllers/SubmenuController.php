<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submenu;
use App\Models\Menu;

class SubmenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $menuId)
    {
        $submenus = Submenu::with('menu')->where('menu_id', $menuId);
        if (request('cari')) {
            $submenus = $submenus->where('nama', 'like', '%' . request('cari') . '%');
        }
        $submenus = $submenus->latest()->get();

        $menu = Menu::select(['id', 'nama'])->find($menuId);
        
        return view('admin.properties.menu.submenu.index', compact('submenus', 'menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $menuId)
    {
        return view('admin.properties.menu.submenu.create', compact('menuId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // @dd($request);
        $request->validate([
            'nama' => 'required|max:255',
            'url' => 'nullable|max:255',
            'menu_id' => 'required',
        ],$this->feedback_validate);

        Submenu::create($request->all());

        return redirect('/menu/submenu/' . $request->menu_id)->with('success', 'Sub Menu Berhasil Dibuat.');
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
    public function edit(Submenu $submenu)
    {
        return view('admin.properties.menu.submenu.edit', [
            'item' => $submenu
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, submenu $submenu)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'url' => 'nullable|max:255',
        ],$this->feedback_validate);

        $submenu->update(array_merge($request->all(), ['menu_id' => $submenu->menu_id]));

        return redirect('/menu/submenu/' . $submenu->menu_id)->with('success', 'Sub Menu Berhasil Diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Submenu $submenu)
    {
        $submenu->delete();
        return redirect('/menu/submenu/' . $submenu->menu_id)->with('success', 'Data berhasil dihapus');
    }
}
