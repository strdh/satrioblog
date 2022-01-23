<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontPage\FrontPageController;

Route::get('/', [FrontPageController::class, 'index'])->name('frontpage.index');
Route::get('/allpost', [FrontPageController::class, 'posts'])->name('frontpage.allpost');
Route::get('/post/{post:slug}', [FrontPageController::class, 'post'])->name('frontpage.post');
Route::get('/allcategory', [FrontPageController::class, 'categories'])->name('frontpage.allcategory');
Route::get('/post/categories/{categories:slug}', [FrontPageController::class, 'postByCategory'])->name('frontpage.by_category');
Route::get('/message', [FrontPageController::class, 'message'])->name('frontpage.message');
Route::post('/message', [FrontPageController::class, 'sendMessage'])->name('frontpage.message.store');
Route::get('/contact', [FrontPageController::class, 'contacts'])->name('frontpage.contact');
Route::get('/about', [FrontPageController::class, 'abouts'])->name('frontpage.about');

Route::prefix('management')
		->as('management.')
		->group(__DIR__.'/management.php');

Route::prefix('writer')
		->as('writer.')
		->group(__DIR__.'/writer.php');
