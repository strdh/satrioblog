<?php

namespace App\Repositories\Management;
use App\Models\AboutMe;
use App\Helpers\FileHelper;
use DataTables;

class AboutRepository
{
    public function store($request)
    {
        $file = FileHelper::upload($request->file('image'));
        $about = AboutMe::create([
            'name' => $request->input('name'),
            'short_description' => $request->input('short_description'),
            'image' => $file["path"],
            'content' => $request->input('content')
        ]);
        return $about ? true : false;
    }

    public function getAbout()
    {
        $data = AboutMe::latest()->get();
        return DataTables::of($data)
            ->editColumn('created_at', function ($data) {
                return date('m/d/Y', strtotime($data->created_at));
            })
            ->editColumn('image', function ($data) {
                $img = '<img src="'.url('/images/dummy.jpg').'" width="90" height="70">';
                if ($data->image) {
                    $url = FileHelper::getUrl($data->image);
                    $img = '<img src="'.$url.'" width="70" height="70">';
                }
                return $img;
            })
            ->addColumn('detail', function ($data) {
                $link = '<a href="'.route('frontpage.about').'" target="_blank"><i class="far fa-eye"></i></a>';
                return $link;
            })
            ->addColumn('action', function ($data) {
                $action =  '<div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <a href="'.route('management.about.edit', $data->id).'" class="btn btn-primary">Edit</a>
                                </div>
                                <div class="col-auto">
                                    <form class="" action="'.route('management.about.destroy', $data->id).'" onclick="return confirm('."'"."Yakin ?"."'".')"  method="POST">
                                        '.csrf_field().''.method_field("DELETE").'
                                        <input type="hidden" value="DELETE" name="_method">
                                        <input type="submit" value="Del" class="btn btn-danger">
                                    </form>
                                </div>
                            </div>';
                return $action;
            })
            ->rawColumns(['image', 'detail', 'action'])
            ->make(true);
    }

    public function update($request, $id)
    {
        $about = AboutMe::FindOrFail($id);
        $edit = [
            'name' => $request->input('name'),
            'short_description' => $request->input('short_description'),
            'content' => $request->input('content'),
        ];
        $new_img = $request->file('image');
        if ($new_img) {
            FileHelper::delete('public/'.$about->image);
            $file = FileHelper::upload($new_img);
            $edit["image"] = $file["path"];
        }
        $about->update($edit);
        return;
    }

    public function del($id)
    {
        $about = AboutMe::findOrFail($id);
        FileHelper::delete('public/'.$about->image);
        $about->delete();
        return;
    }
}