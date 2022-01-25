<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        $path = preg_replace('/[^a-z]+/i', '', $request->getPathInfo());
        if (! $request->expectsJson()) {
            if ($path == "management") {
                return route('management.login');
            } else if ($path == "writer") {
                return route('writer.login');
            }
            return route('management.login');
        }
    }
}
