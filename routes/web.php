<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontPage\FrontPageController;
use App\Http\Controllers\Management\ManagementController;

Route::get('/', [FrontPageController::class, 'index'])->name('frontpage.index');
Route::get('/allpost', [FrontPageController::class, 'posts'])->name('frontpage.allpost');
Route::get('/post/{post:slug}', [FrontPageController::class, 'post'])->name('frontpage.post');
Route::get('/allcategories', [FrontPageController::class, 'categories'])->name('frontpage.allcategory');
Route::get('/post/categories/{categories:slug}', [FrontPageController::class, 'postByCategory'])->name('frontpage.by_category');

Route::prefix('management')
		->as('management.')
		->group(function() {
            Route::get('/', [ManagementController::class, 'index'])->name('index');
        });