<?php

namespace App\Http\Controllers;

use App\Models\QuestAnswer;
use Illuminate\Http\Request;

class QuestAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questAnswer = QuestAnswer::latest();
        if(request('cari')){
            $questAnswer = $questAnswer->where('judul', 'like', '%' . request('cari') . '%');
        }
        $questAnswer = $questAnswer->get();
        return view('admin.properties.q&a.index', compact('questAnswer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.properties.q&a.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validatedData = $request->validate([
        'judul' => 'required|max:255',
        'deskripsi' => 'required',
    ], $this->feedback_validate);

    QuestAnswer::create($validatedData);

    return redirect('/quest_answer')->with('success', 'Pertanyaan dan jawaban baru telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(QuestAnswer $questAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuestAnswer $questAnswer)
    {
        return view('admin.properties.q&a.edit', [
            'item' => $questAnswer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuestAnswer $questAnswer)
    {
        $validatedData = $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'required'
        ], $this->feedback_validate);

        $questAnswer->update($validatedData);

        return redirect('/quest_answer')->with('success', 'Pertanyaan dan jawaban telah diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuestAnswer $questAnswer)
    {
        $questAnswer->delete();
        return redirect('/quest_answer')->with('success', 'Pertanyaan dan jawaban telah dihapus!');
    }
}
