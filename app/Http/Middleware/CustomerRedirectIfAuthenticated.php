<?php

namespace App\Http\Middleware;

use App\Helpers\MyHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerRedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (MyHelper::customerCheck()) {
            return to_route('user.account.profile');
        }

        return $next($request);
    }
}
