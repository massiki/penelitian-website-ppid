<?php

namespace App\Http\Controllers;

use App\Models\BackgroundImage;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BackgroundImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = BackgroundImage::latest()->get();
        $logos = $images->where('slug', 'logo');
        $banners = $images->where('slug', 'banner');
        $thumbnails = $images->where('slug', 'thumbnail');
        $questAnswars = $images->where('slug', 'q&a');
        $videos = Video::latest()->get();
        return view('admin.properties.imageVideo.index', compact('logos', 'banners', 'thumbnails', 'questAnswars', 'videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $slug)
    {
        return view('admin.properties.imageVideo.image.create', compact('slug'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|file|mimes:jpg,png,jpeg,pdf|max:2048',
        ], $this->feedback_validate );

        $image = $request->file('image');
        $file_org =  $image->getClientOriginalName();
        $random_name = Str::random(5);
        $file_name = $random_name . '-' . $file_org;
        $file_path = $image->storeAs('image', $file_name, 'public');

        BackgroundImage::create([
            'slug' => $request->slug,
            'image' => $file_path
        ]);

        return redirect('/image_video')->with('success', ucfirst($request->slug) . ' berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(BackgroundImage $backgroundImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug, BackgroundImage $backgroundImage)
    {
        return view('admin.properties.imageVideo.image.edit', [
            'slug' => $slug,
            'item' => $backgroundImage
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BackgroundImage $backgroundImage)
    {
        $request->validate([
            'image' => 'file|mimes:jpg,png,jpeg,pdf|max:2048',
        ], $this->feedback_validate );

        if ($request->image) {
            $image = $request->file('image');
            $file_org =  $image->getClientOriginalName();
            $random_name = Str::random(5);
            $file_name = $random_name . '-' . $file_org;
            $file_path = $image->storeAs('image', $file_name, 'public');
            Storage::disk('public')->delete($backgroundImage->image);
        } else {
            $file_path = $backgroundImage->image;
        }

        $backgroundImage->update([
            'image' => $file_path,
        ]);

        return redirect('/image_video')->with('success', ucfirst($backgroundImage->slug) . ' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BackgroundImage $backgroundImage)
    {
        $file_name = $backgroundImage->image;
        if ($file_name && Storage::disk('public')->exists($file_name)) {
            Storage::disk('public')->delete($file_name);
        }
        $backgroundImage->delete();
        return redirect('/image_video')->with('success', ucfirst($backgroundImage->slug) . ' berhasil dihapus');
    }
}
