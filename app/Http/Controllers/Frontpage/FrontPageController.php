<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

use Carbon\Carbon;

class FrontPageController extends Controller
{
    public function index()
    {
        return view('frontpage.index');
    }

    public function categories()
    {
       $categories = Category::latest()->get();
       $jumbotron = "All post categories";
       return view('frontpage.post.category', ['jumbotron' => $jumbotron, 'categories' => $categories]);
    }

    public function posts()
    {
        $posts = Post::with(['categories'])->latest();
        $jumbotron = "All post";
        if (request('search')) {
            $posts->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('content', 'like', '%' . request('search'));
            $jumbotron = "Result for : ".request('search');
        }

        return view('frontpage.post.index', ['jumbotron' => $jumbotron,'posts' => $posts->get()]);
    }

    public function postByCategory(Category $categories)
    {
        return view('frontpage.post.index', ['jumbotron' => "Post by category : ".$categories->name, 'posts' => $categories->posts->load('categories')]);
    }

    public function post(Post $post)
    {
        return view('frontpage.post.post', ['post' => $post]);
    }
}
