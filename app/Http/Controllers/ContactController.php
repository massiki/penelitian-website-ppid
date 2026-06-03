<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Suggestion;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::latest();
        if (request('cari')) {
            $contacts = $contacts->where('address', 'like', '%' . request('cari') . '%');
        }
        $contacts = $contacts->get();
        return view('admin.properties.contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.properties.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'address' => 'required',
            'icon' => 'required',
        ], $this->feedback_validate);

        Contact::create($validatedData);

        return redirect('/kontak')->with('success', 'Kontak baru berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('admin.properties.contact.edit', [
            'item' => $contact
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $validatedData = $request->validate([
            'address' => 'required',
            'icon' => 'required',
        ], $this->feedback_validate);

        $contact->update($validatedData);

        return redirect('/kontak')->with('success', 'Kontak berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect('/kontak')->with('success', 'Kontak berhasil dihapus.');
    }

    public function front()
    {
        return view('user.contact.index');
    }

    public function submit(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email:rfc,dns|max:255',
            'phone'     => 'required|string|max:255',
            'subject'   => 'required|string|max:255',
            'message'   => 'required|string',
        ], $this->feedback_validate);

        Suggestion::create($validatedData);
        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim.');
    }

    public function contactSuggestion()
    {
        $suggestions = Suggestion::latest('id')->paginate(10);
        return view('admin.properties.suggestion.index', compact('suggestions'));
    }
}
