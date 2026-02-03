<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {

            // Customer guard → customer login
            if (auth()->guard('customer')->guest()) {
                return route('user.account.login');
            }

            // Default → admin/user login
            return route('login');
        }

        return null;
    }
}
