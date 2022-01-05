<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Helpers\FileHelper;
use Facades\App\Repositories\Management\PostRepository;

class PostController extends Controller
{
    public function index()
    {
        return view('management.post.index');
    }

    public function postTable()
    {
        return PostRepository::getPost();
    }

    public function create()
    {
        $categories = Category::latest()->get();
        return view('management.post.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate(Post::$rules);
        $post = PostRepository::store($request);
        if ($post) {
            return redirect(route('management.post.create'))->with('success', 'Data berhasil disimpan');
        } else {
            return redirect(route('management.post.create'))->with('danger', 'Data gagal disimpan');
        }
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $post = Post::FindOrFail($id);
        $thumbnail = FileHelper::getUrl($post['thumbnail']);
        $categories = Category::latest()->get();
        return view('management.post.edit', ['post' => $post, 'categories' => $categories, 'thumbnail' => $thumbnail]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(Post::$rules);
        $post = PostRepository::update($request, $id);
        if ($post) {
            return redirect(route('management.post.index'))->with('success', 'Data berhasil diupdate');
        } else {
            return redirect(route('management.post.index'))->with('danger', 'Data gagal diupdate');
        }
    }

    public function destroy($id)
    {
        $post = PostRepository::del($id);
        if ($post) {
            return redirect(route('management.post.index'))->with('warning', 'Data telah dihapus');
        } else {
            return redirect(route('management.post.index'))->with('danger', 'Data gagal diupdate');
        }
    }

    public function uploadEditor(Request $request){
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);

            $url = asset('media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }
}
