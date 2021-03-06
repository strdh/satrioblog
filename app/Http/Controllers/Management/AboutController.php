<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Management\AboutRequest;
use App\Models\AboutMe;
use Facades\App\Repositories\Management\AboutRepository;

class AboutController extends Controller
{
    public function index()
    {
        return view('management.about.index');
    }

    public function aboutTable()
    {
        return AboutRepository::getAbout();
    }

    public function create()
    {
        return view('management.about.create');
    }

    public function store(AboutRequest $request)
    {
        AboutRepository::store($request);
        return redirect(route('management.about.index'))->with('success', 'About berhasil ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $about = AboutMe::findOrFail($id);
        return view('management.about.edit', ['about' => $about]);
    }

    public function update(AboutRequest $request, $id)
    {
        AboutRepository::update($request, $id);
        return redirect(route('management.about.index'))->with('success', 'About berhasil diupdate');
    }

    public function destroy($id)
    {
        AboutRepository::del($id);
        return redirect(route('management.about.index'))->with('warning', 'About berhasil dihapus');
    }
}
