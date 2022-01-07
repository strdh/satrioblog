<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = User::whereUsername(Auth::user()->username)->first();
        return view('management.user.profile', ['profile' => $profile]);
    }
}
