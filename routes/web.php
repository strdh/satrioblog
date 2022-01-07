<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontPage\FrontPageController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Management\ManagementController;
use App\Http\Controllers\Management\SliderController;
use App\Http\Controllers\Management\ContactController;
use App\Http\Controllers\Management\AboutController;
use App\Http\Controllers\Management\CategoryController;
use App\Http\Controllers\Management\PostController;
use App\Http\Controllers\Management\ProfileController;

Route::get('/', [FrontPageController::class, 'index'])->name('frontpage.index');
Route::get('/allpost', [FrontPageController::class, 'posts'])->name('frontpage.allpost');
Route::get('/post/{post:slug}', [FrontPageController::class, 'post'])->name('frontpage.post');
Route::get('/allcategories', [FrontPageController::class, 'categories'])->name('frontpage.allcategory');
Route::get('/post/categories/{categories:slug}', [FrontPageController::class, 'postByCategory'])->name('frontpage.by_category');

Route::prefix('management')
		->as('management.')
		->group(function() {
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
            });
        });