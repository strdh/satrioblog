<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\WriterAuthController;
use App\Http\Controllers\Writer\WriterController;
use App\Http\Controllers\Writer\PostController;

Route::get('/register', [WriterAuthController::class, 'register'])->name('register');
Route::post('/register', [WriterAuthController::class, 'createUser'])->name('createuser');
Route::get('/login', [WriterAuthController::class, 'login'])->name('login');
Route::post('/login', [WriterAuthController::class, 'validateUser'])->name('validateuser');
Route::get('/logout', [WriterAuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth:writer']], function() {
    Route::get('/', [WriterController::class, 'index'])->name('index');
    Route::resource('/post', PostController::class);
});