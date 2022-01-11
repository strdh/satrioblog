<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\FileHelper;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = User::whereUsername(Auth::user()->username)->first();
        if ($profile->avatar) {
            $profile->avatar = FileHelper::getUrl($profile->avatar);
        }
        return view('management.user.profile', ['profile' => $profile]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required:min:3',
            'email' => 'unique:users,email,'.Auth::user()->id,
        ]);

        $user = User::FindOrFail(Auth::user()->id);
        $data = $request->except(['avatar']);
        if ($request->file('avatar')) {
            if ($user['avatar']) {
                FileHelper::delete('public/'.$user['avatar']);
            }
            $avatar = FileHelper::upload($request->file('avatar'));
            $data['avatar'] = $avatar['path'];
        }
        $user = $user->update($data);
        return redirect(route('management.user.profile'))->with('success', 'Berhasil diupdate');
    }

    public function editPassword(Request $request)
    {
        return view('management.user.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8|max:100',
            'oldpass' => 'required|current_password:admin',
        ]);

        $user = User::FindOrFail(Auth::user()->id);
        $password = Hash::make($request->input('password'));
        $user = $user->update(['password' => $password]);
        return redirect(route('management.user.profile'))->with('success', 'Berhasil diupdate');
    }
}
