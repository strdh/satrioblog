<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainMenu;
use Facades\App\Repositories\Management\MainMenuRepository;

class MainMenuController extends Controller
{
    public function index()
    {
        return view('management.mainmenu.index');
    }

    public function mainmenuTable()
    {
        return MainMenuRepository::getMainMenu();
    }

    public function create()
    {
        $parents = MainMenu::latest()->get();
        return view('management.mainmenu.create', ['parents' => $parents]);
    }

    public function store(Request $request)
    {
        $request->validate(MainMenu::$rules);
        $mainmenu = MainMenuRepository::store($request);
        return redirect(route('management.mainmenu.create'))->with('success', 'Berhasil ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $parents = MainMenu::latest()->get();
        $mainmenu = MainMenu::FindOrFail($id);
        return view('management.mainmenu.edit', ['mainmenu' => $mainmenu, 'parents' => $parents]);
    }

    public function update(Request $request, $id)
    {
        $mainmenu = MainMenuRepository::update($request, $id);
        return redirect(route('management.mainmenu.index'))->with('success', 'Berhasil diupdate');
    }

    public function destroy($id)
    {
        $mainmenu = MainMenuRepository::del($id);
        return redirect(route('management.mainmenu.index'))->with('warning', 'File Telah dihapus');
    }
}
