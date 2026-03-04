<?php

namespace App\Providers;

use App\Models\Admin\Category;
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
    }
}
