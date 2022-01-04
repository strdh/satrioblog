<?php

namespace App\Repositories\Management;
use App\Models\Post;
use App\Helpers\FileHelper;
use DataTables;
use Illuminate\Support\Str;

class PostRepository
{
    public function store($request)
    {
        $data = [
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'thumbnail' => '',
            'category_id' => $request->input('category_id'),
            'content' => $request->input('content'),
        ];
        if ($request->file('thumbnail')) {
            $file = FileHelper::upload($request->file('thumbnail'));
            $data['thumbnail'] = $file['path'];
        }
        $post = Post::create($data);
        return $post ? true : false;
    }

    public function update($request, $id)
    {

    }

    public function getPost()
    {
        $data = Post::with(['categories'])->latest()->get();
        return DataTables::of($data)
            ->editColumn('category_id', function ($data) {
                return $data->categories->name;
            })
            ->editColumn('thumbnail', function ($data) {
                $url = FileHelper::getUrl($data->thumbnail);
                $img = '<img src="'.$url.'" width="70" height="70">';
                return $img;
            })
            ->addColumn('detail', function ($data) {
                $link = '<a href="'.$data->id.'"><i class="far fa-eye"></i></a>';
                return $link;
            })
            ->editColumn('created_at', function ($data) {
                return date('m/d/Y', strtotime($data->created_at));
            })
            ->editColumn('updated_at', function ($data) {
                return date('m/d/Y', strtotime($data->updated_at));
            })
            ->addColumn('action', function ($data) {
                $action =  '<div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <a href="'.route('management.post.edit', $data->id).'" class="btn btn-primary">Edit</a>
                                </div>
                                <div class="col-auto">
                                    <form class="" action="'.route('management.post.destroy', $data->id).'" onclick="return confirm('."'"."Yakin ?"."'".')"  method="POST">
                                        '.csrf_field().''.method_field("DELETE").'
                                        <input type="hidden" value="DELETE" name="_method">
                                        <input type="submit" value="Del" class="btn btn-danger">
                                    </form>
                                </div>
                            </div>';
                return $action;
            })
            ->rawColumns(['thumbnail', 'detail', 'action'])
            ->make(true);
    }

    public function del($id)
    {

    }
}