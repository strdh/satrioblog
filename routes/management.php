<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Management\ManagementController;
use App\Http\Controllers\Management\SliderController;
use App\Http\Controllers\Management\ContactController;
use App\Http\Controllers\Management\AboutController;
use App\Http\Controllers\Management\CategoryController;
use App\Http\Controllers\Management\PostController;
use App\Http\Controllers\Management\ProfileController;
use App\Http\Controllers\Management\MessageController;
use App\Http\Controllers\Management\MainMenuController;

Route::get('/register', [AdminAuthController::class, 'register'])->name('register');
Route::post('/register', [AdminAuthController::class, 'createUser'])->name('createuser');
Route::get('/login', [AdminAuthController::class, 'login'])->name('login');
Route::post('/login', [AdminAuthController::class, 'validateUser'])->name('validateuser');
Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
//middleware admin
Route::group(['middleware' => ['auth:admin']], function(){
    Route::get('/', [ManagementController::class, 'index'])->name('index');
    //slider
    Route::resource('/slider', SliderController::class);
    Route::get('/table/slider', [SliderController::class, 'sliderTable'])->name('table.slider');
    //contact
    Route::resource('/contact', ContactController::class);
    Route::get('/table/contact', [ContactController::class, 'contactTable'])->name('table.contact');
    //about
    Route::resource('/about', AboutController::class);
    Route::get('/table/about', [AboutController::class, 'aboutTable'])->name('table.about');
    //category
    Route::resource('/category', CategoryController::class);
    Route::get('/table/category', [CategoryController::class, 'categoryTable'])->name('table.category');
    //post
    Route::resource('/post', PostController::class);
    Route::get('/table/post', [PostController::class, 'postTable'])->name('table.post');
    Route::post('/post/upload', [PostController::class, 'uploadEditor'])->name('post.cke');
    //profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('user.update');
    Route::put('/profile/password/', [ProfileController::class, 'updatePassword'])->name('user.password.update');
    Route::get('/profile/password/', [ProfileController::class, 'editPassword'])->name('user.password.edit');
    //message
    Route::get('/message', [MessageController::class, 'index'])->name('message');
    Route::get('/table/message', [MessageController::class, 'messageTable'])->name('table.message');
    //main menu
    Route::resource('/mainmenu', MainMenuController::class);
    Route::get('/table/mainmenu', [MainMenuController::class, 'mainmenuTable'])->name('table.mainmenu');
});