<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::latest();
        if(request('cari')){
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
}
