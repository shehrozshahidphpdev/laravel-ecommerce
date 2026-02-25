<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('children.children')->whereNull('parent_id')->get();
        $featuredCategories = Category::whereJsonLength('tags', 0)
            ->whereNotNull('image')
            ->with('products')
            ->limit(5)
            ->get();
        $featuredProducts = Product::where('is_featured', 1)->limit(8)->get();
        $newProducts = Product::orderByDesc('created_at')->limit(8)->get();

        // return $categories;
        return view('user.index', [
            'categories' => $categories,
            'featuredCategories' => $featuredCategories,
            'featuredProducts' => $featuredProducts,
            'newProducts' =>  $newProducts
        ]);
    }
}
