<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Illuminate\Http\Request;

use function Symfony\Component\Clock\now;

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
        $featuredProducts = Product::with(['category', 'images'])
            ->where('is_featured', 1)
            ->limit(8)
            ->get();
        $newProducts = Product::with(['category', 'images', 'tag' => function ($query) {
            $query->with('color');
        }])
            ->orderByDesc('created_at')
            ->limit(8)
            ->get();

        $productsOnDeal = Product::with(['images', 'category'])
            ->where('deal_of_the_day',  '1')
            ->where('deal_expiration_date',  '>',  now())
            ->get();

        $category = Category::where('name', 'Electronics')->first();

        $categoryIds = $category->getAllChildrenIds();
        $electronicProducts = Product::with(['category', 'images', 'tag' => function ($query) {
            $query->with('color');
        }])
            ->whereIn('category_id', $categoryIds)
            ->where('is_active', 1)
            ->limit(6)
            ->get();

        // return $newProducts;

        // return $productsOnDeal;

        return view('user.index', [
            'categories' => $categories,
            'featuredCategories' => $featuredCategories,
            'featuredProducts' => $featuredProducts,
            'newProducts' =>  $newProducts,
            'productsOnDeal' => $productsOnDeal,
            'electronicProducts' => $electronicProducts
        ]);
    }
}
