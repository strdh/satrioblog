<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Facades\App\Repositories\Management\ContactRepository;

class ContactController extends Controller
{
    public function index()
    {
        return view('management.contact.index');
    }

    public function contactTable()
    {
        return ContactRepository::getContact();
    }

    public function create()
    {
        return view('management.contact.create');
    }

    public function store(Request $request)
    {
        $request->validate(Contact::$rules);
        Contact::create($request->all());
        return redirect(route('management.contact.create'))->with('success', 'Contact berhasil ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('management.contact.edit', ['contact' => $contact]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(Contact::$rules);
        $contact = Contact::findOrFail($id);
        $contact->update($request->except('_token'));
        return redirect(route('management.contact.index'))->with('success', 'Contact berhasil diupdate');
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect(route('management.contact.index'))->with('warning', 'Contact telah dihapus');
    }
}
