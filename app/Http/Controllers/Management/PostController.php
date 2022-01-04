<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
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
        //
    }

    public function edit($id)
    {
        $post = Post::FindOrFail($id);
        $categories = Category::latest()->get();
        return view('management.post.edit', ['post' => $post, 'categories' => $categories]);
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
