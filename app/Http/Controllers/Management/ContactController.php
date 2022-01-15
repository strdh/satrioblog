<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\ContactRequest;
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

    public function store(ContactRequest $request)
    {
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

    public function update(ContactRequest $request, $id)
    {
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
