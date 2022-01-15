<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Management\PostRequest;
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

    public function store(PostRequest $request)
    {
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

    public function update(PostRequest $request, $id)
    {
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
        return PostRepository::uploadEditor($request);
    }
}
