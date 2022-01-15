<?php

namespace App\Repositories\Management;
use App\Models\Category;
use App\Models\Post;
use App\Helpers\FileHelper;
use DataTables;
use Illuminate\Support\Str;

class CategoryRepository
{
    public function store($request)
    {
        $name = $request->input('name');
        $data = [
            'name' => $name,
            'slug' => Str::slug($name),
            'image' => null
        ];

        if ($request->file('image')) {
            $file = FileHelper::upload($request->file('image'));
            $data["image"] = $file["path"];
        }

        $category = Category::create($data);
        return $category ? true : false;
    }

    public function update($request, $id)
    {
        $category = Category::FindOrFail($id);
        $name = $request->input('name');
        $edit = [
            'name' => $name,
            'slug' => Str::slug($name),
        ];

        $new_img = $request->file('image');
        
        if ($new_img) {
            FileHelper::delete('public/'.$category->image);
            $file = FileHelper::upload($new_img);
            $edit["image"] = $file["path"];
        }

        $category->update($edit);
        return;
    }

    public function del($id)
    {
        $category = Category::FindOrFail($id);
        if ($category["image"]) {
            FileHelper::delete('public/'.$category["image"]);
        }
        if (!Post::where('category_id', $id)->first()) {
            $category->delete();
            return true;
        }
        return false;
    }

    public function getCategory()
    {
        $data = Category::latest()->get();
        return Datatables::of($data)
            ->editColumn('created_at', function($data) {
                return date('m/d/Y', strtotime($data->created_at));
            })
            ->editColumn('image', function($data) {
                $img = '<img src="'.url('/images/dummy.jpg').'" width="70" height="70">';
                if ($data->image) {
                    $url = FileHelper::getUrl($data->image);
                    $img = '<img src="'.$url.'" width="70" height="70">';
                }
                return $img;
            })
            ->addColumn('action', function($data) {
                $action = '<div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <a href="'.route('management.category.edit', $data->id).'" class="btn btn-primary">Edit</a>
                                </div>
                                <div class="col-auto">
                                    <form class="" action="'.route('management.category.destroy', $data->id).'" onclick="return confirm('."'"."Yakin ?"."'".')"  method="POST">
                                        '.csrf_field().''.method_field("DELETE").'
                                        <input type="hidden" value="DELETE" name="_method">
                                        <input type="submit" value="Del" class="btn btn-danger">
                                    </form>
                                </div>
                            </div>';
                return $action;
            })
            ->rawColumns(['action', 'image'])
            ->make(true);
    }
}