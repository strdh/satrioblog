<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
// use Facades\App\Repositories\AdminaAuthRepository;

class AdminAuthController extends Controller
{
    public function register()
    {
        if (Auth::check()) {
            return redirect('management');
        } 
        return view('management.auth.register');
    }

    public function createUser(Request $request)
    {
        $request->validate(User::$rules);
        $request = $request->all();
        $request["password"] = Hash::make($request["password"]);
        $user = User::create($request);
        if ($user) {
            return redirect('management/login')->with('status', 'Register Successfully');
        } else {
            return redirect('management/register')->with('status', 'Register Failed');
        }
    }
    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect('management');
        }
        return view('management.auth.login');
    }

    public function validateUser(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('management')->withSuccess('Signed in');
        }
        return redirect(route('management.login'))->withDanger('Username atau password salah');
    }

    public function logout()
    {
        Session::flush();
        return redirect(route('management.login'));
    }
}
