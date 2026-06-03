<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        $ratings = Rating::latest();
        if (request('cari')) {
            $ratings = $ratings->whereHas('pemohon', function($query) {
                $query->where('nama', 'like', '%' . request('cari') . '%');
            });
        }
        $ratings = $ratings->paginate(5);
        return view('admin.menuUtama.rating.index', compact('ratings'));
    }

    public function post(Rating $rating)
    {
        $rating->update([
            'status_post' => 2
        ]);

        return redirect('/rating')->with('success', 'Komentar dipost');
    }

    public function notpost(Rating $rating)
    {
        $rating->update([
            'status_post' => 0
        ]);

        return redirect('/rating')->with('success', 'Komentar tidak dipost');
    }
}
