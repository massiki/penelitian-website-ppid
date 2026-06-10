<?php

namespace App\Http\Controllers;

use App\Models\Panduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PanduanController extends Controller
{
    public function index()
    {
        $panduan = Panduan::all();
        return view('admin.properties.panduan.index', compact('panduan'));
    }

    public function edit(Panduan $panduan)
    {
        return view('admin.properties.panduan.edit', compact('panduan'));
    }

    public function update(Request $request, Panduan $panduan)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'video_url' => 'nullable|string|max:255',
            'deskripsi_konten' => 'nullable|string',
            'persyaratan' => 'nullable|json',
            'langkah' => 'nullable|json',
            'status_list' => 'nullable|json',
            'is_active' => 'nullable|boolean',
        ], $this->feedback_validate);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'video_url' => $request->video_url,
            'deskripsi_konten' => $request->deskripsi_konten,
            'persyaratan' => $request->persyaratan ? json_decode($request->persyaratan, true) : null,
            'langkah' => $request->langkah ? json_decode($request->langkah, true) : null,
            'status_list' => $request->status_list ? json_decode($request->status_list, true) : null,
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('gambar')) {
            if ($panduan->gambar) {
                Storage::delete('public/' . $panduan->gambar);
            }
            $data['gambar'] = $this->compressImage($request->file('gambar'), 'panduan');
            // $data['gambar'] = $request->file('gambar')->store('panduan', 'public');
        }

        $panduan->update($data);

        return redirect('/panduan')->with('success', 'Panduan berhasil diperbarui.');
    }
}
