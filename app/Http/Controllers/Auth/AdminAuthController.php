<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Models\User;
// use Illuminate\Validation\Validator;

class AdminAuthController extends Controller
{
    public function register()
    {
        return view('management.auth.register');
    }

    public function createUser(Request $request)
    {
        $request->validate(User::$rules);
        $request = $request->all();
        dd($request);
        // $request["password"] = Hash::make($request->passwrod);
        // $user = User::create($request);
        // if ($user) {
        //     return redirect('management.login')->with('status', 'Register Successfully');
        // } else {
        //     return redirect('management.register')->with('status', 'Register Failed');
        // }
    }
    public function login(Request $request)
    {
        return view('management.auth.login');
    }

}
