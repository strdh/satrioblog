<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        return AboutRepository::getAbouts();
    }

    public function create()
    {
        return view('management.about.create');
    }

    public function store(Request $request)
    {
        $request->validate(AboutMe::$rules);
        AboutRepository::store($request);
        return redirect(route('management.about.index'))->with('success', 'About berhasil ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $about = About::findOrFail($id);
        return view('maangement.about.edit', ['about' => $about]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $about = About::findOrFail($id);
        $about->delete();
        return redirect(route('management.about.index'))->with('warning', 'About berhasil dihapus');
    }
}
