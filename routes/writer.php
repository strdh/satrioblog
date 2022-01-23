<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\WriterAuthController;

Route::get('/register', [WriterAuthController::class, 'register'])->name('register');
Route::post('/register', [WriterAuthController::class, 'createUser'])->name('createuser');
Route::get('/login', [WriterAuthController::class, 'login'])->name('login');
Route::post('/login', [WriterAuthController::class, 'validateUser'])->name('validateuser');
Route::get('/logout', [WriterAuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth:writer']], function() {
    
});