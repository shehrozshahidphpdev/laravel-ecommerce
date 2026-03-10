<?php

namespace App\Providers;

use App\Models\Admin\Category;
use App\Models\User\Wishlist;
use Illuminate\Support\Facades\Auth;
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
        $categories = Category::with('children.children')->whereNull('parent_id')->get();
        view()->share('categories', $categories);

        // wishlists
        $wishlistCount = 0;
        View::composer('*', function ($view) use ($wishlistCount) {
            if (Auth::guard('customer')->check()) {
                $wishlistCount = Wishlist::where('customer_id', Auth::guard('customer')->id())
                    ->count();
            }

            $view->with('wishlistCount', $wishlistCount);
        });
    }
}
