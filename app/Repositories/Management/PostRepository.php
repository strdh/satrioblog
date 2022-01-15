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
        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        // dd($data);
        if ($request->file('thumbnail')) {
            $file = FileHelper::upload($request->file('thumbnail'));
            $data['thumbnail'] = $file['path'];
        }
        $post = Post::create($data);
        return $post ? true : false;
    }

    public function update($request, $id)
    {
        $post = Post::FindOrFail($id);
        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        if ($request->file('thumbnail_')) {
            FileHelper::delete('public/'.$post->thumbnail);
            $file = FileHelper::upload($request->file('thumbnail_'));
            $data['thumbnail'] = $file['path'];
        }
        $post = $post->update($data);
        return $post ? true : false;
    }

    
    public function del($id)
    {
        $post = Post::findOrFail($id);
        if ($post) {
            if ($post->thumbnail) {
                // dd("Masuk");
                FileHelper::delete('public/'.$post->thumbnail);
            }
            $post = $post->delete();
            return $post ? true : false;
        }
        return false; 
    }

    public function uploadEditor($request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);

            $url = asset('media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
        return false;
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
            ->editColumn('status', function ($data) {
                if ($data->status == 'publish') {
                    return '<span class="badge bg-primary">'.$data->status.'</span>';
                } else if ($data->status == 'draft') {
                    return '<span class="badge bg-stat">'.$data->status.'</span>';
                }
            })
            ->addColumn('liveview', function ($data) {
                $link = '<a href="'.route('frontpage.post', $data->slug).'" target="_blank"><i class="far fa-eye"></i></a>';
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
            ->rawColumns(['thumbnail', 'status', 'liveview', 'action'])
            ->make(true);
    }
}