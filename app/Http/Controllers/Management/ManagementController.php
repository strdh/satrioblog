<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\MainMenu;
use App\Models\Contact;
use App\Models\Slider;
class ManagementController extends Controller
{
    public function index()
    {
        $rowCount = [
            "post" => Post::count(),
            "category" => Category::count(),
            "main_menu" => MainMenu::count(),
            "contact" => Contact::count(),
            "slider" => Slider::count() 
        ];
        
        return view('management.index', ['rowCount' => $rowCount]);
    }
}
