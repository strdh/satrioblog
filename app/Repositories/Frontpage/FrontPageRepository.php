<?php

namespace App\Repositories\Frontpage;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Contact;
use App\Models\Message;
use App\Models\AboutMe;
use App\Helpers\FileHelper;

class FrontPageRepository
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        $posts = Post::whereStatus('publish')->latest()->limit(3)->get();
        $categories = Category::latest()->limit(4)->get();
        foreach($posts as $key => $value) {
            $posts[$key]['thumbnail'] = FileHelper::getUrl($value['thumbnail']);
        }

        foreach($categories as $key => $value) {
             if ($value['image']) {
                 $categories[$key]['image'] = FileHelper::getUrl($value['image']);
             }
        }

        $data = [
            'sliders' => $sliders,
            'posts' => $posts,
            'categories' => $categories,
        ];

        return $data;
    }

    public function categories()
    {
        $categories = Category::latest()->get();
        foreach($categories as $key => $value) {
             if ($value['image']) {
                 $categories[$key]['image'] = FileHelper::getUrl($value['image']);
             }
        }
        $jumbotron = "All post categories";
        $data = [
            'categories' => $categories,
            'jumbotron' => $jumbotron
        ];
        return $data;
    }

    public function contacts()
    {
        $contacts = Contact::latest()->get();
        $jumbotron = "All Contacts";
        $data = [
            'contacts' => $contacts,
            'jumbotron' => $jumbotron
        ];
        return $data;
    }

    public function abouts()
    {
        $abouts = AboutMe::latest()->get();
        foreach($abouts as $key => $value) {
             if ($value['image']) {
                 $abouts[$key]['image'] = FileHelper::getUrl($value['image']);
             }
        }
        $jumbotron = "About";
        $data = [
            'abouts' => $abouts,
            'jumbotron' => $jumbotron
        ];
        return $data;
    }

    public function posts()
    {
        $posts = Post::whereStatus('publish')->with(['categories'])->latest();
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
        $data = [
            'jumbotron' => $jumbotron,
            'posts' => $posts
        ];

        return $data;
    }

    public function postByCategory(Category $categories)
    {
        $posts = $categories->posts;
         foreach($posts as $key => $value) {
            $posts[$key]['thumbnail'] = FileHelper::getUrl($value['thumbnail']);
        }
        $data = [
            'jumbotron' => "Post by category : ".$categories->name,
            'posts' => $categories->posts->load('categories')
        ];

        return $data;
    }

    public function post(Post $post)
    {
        if ($post['thumbnail']) {
            $post['thumbnail'] = FileHelper::getUrl($post['thumbnail']);
        }
        $data = ['post' => $post];
        return $data;
    }

    public function sendMessage($request)
    {
        $request->validate(Message::$rules);
        $message = Message::create($request->all());
        return $message ? true : false;
    }

}