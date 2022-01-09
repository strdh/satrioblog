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
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
