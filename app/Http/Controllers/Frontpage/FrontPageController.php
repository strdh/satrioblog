<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Message;
use App\Helpers\FileHelper;
use Facades\App\Repositories\Frontpage\FrontPageRepository;

class FrontPageController extends Controller
{
    public function index()
    {
        $index = FrontPageRepository::index();
        return view('frontpage.index', $index);
    }

    public function categories()
    {
       $categories = FrontPageRepository::categories();
       return view('frontpage.post.category', $categories);
    }

    public function posts()
    {
        $posts = FrontPageRepository::posts();
        return view('frontpage.post.index', $posts);
    }

    public function postByCategory(Category $categories)
    {
        $data = FrontPageRepository::postByCategory($categories);
        return view('frontpage.post.index', $data);
    }

    public function post(Post $post)
    {
        $post = FrontPageRepository::post($post);
        return view('frontpage.post.post', $post);
    }

    public function message()
    {
        return view('frontpage.page.message', ['jumbotron' => 'Message']);
    }

    public function sendMessage(Request $request)
    {
        $message = FrontPageRepository::sendMessage($request);
        return redirect(route('frontpage.message'))->with('success', 'Pesan berhasil dikirim');
    }
}
