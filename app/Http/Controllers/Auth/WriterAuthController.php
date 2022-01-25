<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\WriterAuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Writer;

class WriterAuthController extends Controller
{
    public function register()
    {
        if (Auth::check()) {
            return redirect(route('writer.login'));
        } 
        return view('writer.auth.register');
    }

    public function createUser(WriterAuthRequest $request)
    {
        $request = $request->all();
        $request["password"] = Hash::make($request["password"]);
        $user = Writer::create($request);
        if ($user) {
            return redirect('writer/login')->with('success', 'Register Successfully');
        } else {
            return redirect('writer/register')->with('danger', 'Register Failed');
        }
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect(route('writer.login'));
        } 
        return view('writer.auth.login');
    }

    public function validateUser(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::guard('writer')->attempt($credentials)) {
            return redirect(route('writer.index'))->with('success', 'Sign in');
        }
        return redirect(route('writer.login'))->with('danger', 'Username atau password salah');
    }

    public function logout()
    {
        Session::flush();
        return redirect(route('writer.login'));
    }
}
