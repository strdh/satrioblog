<?php

namespace App\Repositories;
use App\Models\User;

class AdminAuthRepository
{
   public function createUser($req)
   {
        $request->validate(User::$rules);
        $request = $request->all();
        $request["password"] = Hash::make($request["password"]);
        $user = User::create($request);
        
   } 
}