<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;

use function Symfony\Component\Clock\now;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('children.children')
            ->whereNull('parent_id')
            ->get();

        $featuredCategories = Category::whereJsonLength('tags', 0)
            ->whereNotNull('image')
            ->with('products:id,category_id')
            ->limit(5)
            ->get();

        $featuredProducts = Product::select('id', 'name', 'tag_id',  'category_id',  'slug', 'original_price', 'discounted_price')
            ->with(['category:id,name', 'images:id,product_id,image_path', 'tag' => function ($query) {
                $query->with('color');
            }])
            ->where('is_featured', 1)
            ->limit(8)
            ->get();

        $newProducts = Product::select('id', 'name', 'tag_id', 'category_id',  'slug', 'original_price', 'discounted_price')
            ->with(['category:id,name', 'images:id,product_id,image_path', 'tag' => function ($query) {
                $query->with('color');
            }])
            ->orderByDesc('created_at')
            ->limit(8)
            ->get();


        $productsOnDeal = Product::select('id', 'name', 'discounted_price', 'original_price')
            ->with(['images:id,product_id,image_path', 'category:id,name'])
            ->where('deal_of_the_day',  '1')
            ->where('deal_expiration_date',  '>',  now())
            ->get();

        $category = Category::select('id', 'name')
            ->where('name', 'Electronics')
            ->first();

        $categoryIds = $category->getAllChildrenIds();

        $electronicProducts = Product::select('id', 'tag_id',  'category_id',  'name', 'original_price', 'discounted_price')
            ->with(['category:id,name', 'images:id,product_id,image_path', 'tag' => function ($query) {
                $query->with('color');
            }])
            ->whereIn('category_id', $categoryIds)
            ->where('is_active', 1)
            ->limit(6)
            ->get();

        $discountedProducts = Product::select('id', 'name',   'category_id',  'slug', 'original_price', 'discounted_price')
            ->with(['category:id,name', 'images:id,product_id,image_path'])
            ->whereNotNull('discounted_price')
            ->limit(3)
            ->get();

        return view('user.index', [
            'categories' => $categories,
            'featuredCategories' => $featuredCategories,
            'featuredProducts' => $featuredProducts,
            'newProducts' =>  $newProducts,
            'productsOnDeal' => $productsOnDeal,
            'electronicProducts' => $electronicProducts,
            'discountedProducts' => $discountedProducts
        ]);
    }
}
