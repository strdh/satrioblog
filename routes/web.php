<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontPage\FrontPageController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Management\ManagementController;

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
            // Route::middleware('authAdmin')->group(function(){
            //     Route::get('/', [ManagementController::class, 'index'])->name('index');
            // });
            Route::group(['middleware' => ['auth:admin']], function(){
                Route::get('/', [ManagementController::class, 'index'])->name('index');
            });
        });