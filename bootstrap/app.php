<?php

use App\Http\Middleware\AdminAuthenticate;
use App\Http\Middleware\AdminRedirectIfAuthenticated;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CustomerRedirectIfAuthenticated;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use SebastianBergmann\CodeCoverage\StaticAnalysisCacheNotConfiguredException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'AdminRedirectIfAuthenticated' => AdminRedirectIfAuthenticated::class,
            'AdminAuthenticate' => AdminAuthenticate::class,
            'CustomerRedirectIfAuthenticated' => CustomerRedirectIfAuthenticated::class,
            'auth' => Authenticate::class
        ]);
    })
    ->withExceptions(using: function (Exceptions $exceptions): void {
        //
    })->create();
