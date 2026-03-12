<?php

namespace App\Providers;

use App\Models\Admin\Category;
use App\Models\User\Wishlist;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFour();


        $categories = Category::with('children.children')->whereNull('parent_id')->get();
        view()->share('categories', $categories);

        // share wishlist count (lowercase key) so every view/component can read it
        $wishlistCount = 0;
        View::composer('*', function ($view) use (&$wishlistCount) {
            if (Auth::guard('customer')->check()) {
                $wishlistCount = Wishlist::where('customer_id', auth('customer')->id())->count();
            }
            $view->with('wishlistCount', $wishlistCount);
        });
        RateLimiter::for('registerUser', function (Request $request) {
            return  Limit::perMinute(2)->by($request->ip());
        });
    }
}
