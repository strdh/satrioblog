<?php

namespace App\Repositories\Management;
use Illuminate\Http\Request;
use App\Models\MainMenu;
use DataTables;

class MainMenuRepository
{
    public function getMainMenu()
    {
        $data = MainMenu::latest()->get();
        return Datatables::of($data)
            ->editColumn("created_at", function($data) {
                return date('m/d/Y', strtotime($data->created_at));
            })
            ->addColumn("view", function($data) {
                $link = '<a href="'.route('management.mainmenu.show', $data->id).'><i class="far fa-eye"></i></a>';
                return $link;
            })
            ->addColumn('action', function ($data) {
                $action =  '<div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <a href="'.route('management.mainmenu.edit', $data->id).'" class="btn btn-primary">Edit</a>
                                </div>
                                <div class="col-auto">
                                    <form class="" action="'.route('management.mainmenu.destroy', $data->id).'" onclick="return confirm('."'"."Yakin ?"."'".')"  method="POST">
                                        '.csrf_field().''.method_field("DELETE").'
                                        <input type="hidden" value="DELETE" name="_method">
                                        <input type="submit" value="Del" class="btn btn-danger">
                                    </form>
                                </div>
                            </div>';
                return $action;
            })
            ->rawColumns(['view', 'action'])
            ->make(true);
    }
}