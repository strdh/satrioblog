<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Message;
use App\Helpers\FileHelper;
use Carbon\Carbon;

class FrontPageController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        $posts = Post::latest()->limit(3)->get();
        $categories = Category::latest()->limit(4)->get();
        foreach($posts as $key => $value) {
            $posts[$key]['thumbnail'] = FileHelper::getUrl($value['thumbnail']);
        }

        foreach($categories as $key => $value) {
             $categories[$key]['image'] = FileHelper::getUrl($value['image']);
        }

        return view('frontpage.index', [
            'sliders' => $sliders,
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    public function categories()
    {
       $categories = Category::latest()->get();
       foreach($categories as $key => $value) {
            $categories[$key]['image'] = FileHelper::getUrl($value['image']);
       }
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
        $posts = $posts->get();
        foreach($posts as $key => $value) {
            $posts[$key]['thumbnail'] = FileHelper::getUrl($value['thumbnail']);
        }
        return view('frontpage.post.index', ['jumbotron' => $jumbotron,'posts' => $posts]);
    }

    public function postByCategory(Category $categories)
    {
        $posts = $categories->posts;
         foreach($posts as $key => $value) {
            $posts[$key]['thumbnail'] = FileHelper::getUrl($value['thumbnail']);
        }
        return view('frontpage.post.index', ['jumbotron' => "Post by category : ".$categories->name, 'posts' => $categories->posts->load('categories')]);
    }

    public function post(Post $post)
    {
        $post['thumbnail'] = FileHelper::getUrl($post['thumbnail']);
        return view('frontpage.post.post', ['post' => $post]);
    }

    public function message()
    {
        return view('frontpage.page.message', ['jumbotron' => 'Message']);
    }

    public function sendMessage(Request $request)
    {
        $request->validate(Message::$rules);
        Message::create($request->all());
        return redirect(route('frontpage.message'))->with('success', 'Pesan berhasil dikirim');
    }
}
