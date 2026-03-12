<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\User\Wishlist;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function quickView(Request $request)
    {
        $id = $request->id;

        $product = Product::with(['category', 'images', 'colors', 'brand', 'tag'])
            ->where('id', $id)
            ->first();

        return response()->json([
            'product' => $product
        ]);
    }

    public function show(string $slug)
    {
        $data['breadcrumbs'] = [];

        $slugs = explode('/', $slug);

        $productSlug = array_pop($slugs);

        foreach ($slugs as $slug) {
            $data['breadcrumbs'][] = Category::select('name', 'slug')->where('slug', $slug)->first();
        }

        $product =  Product::select('name')->where('slug', $productSlug)->first();
        $data['breadcrumbs'][] = [
            'name' => $product->name
        ];

        // return $data['breadcrumbs'];


        $product = Product::with(['category', 'images', 'colors', 'tag', 'specifications'])
            ->where('slug', $productSlug)
            ->first();

        return view('user.show', compact('product', 'data'));
    }

    public function collections(string $full_slug)
    {
        $slug = $full_slug;
        $slugArray = explode('/', $slug);
        $slugEnd = (is_array($slugArray) ? end($slugArray) : $slug);
        $breadCrumb = $slugEnd;

        $category = Category::where('slug', $slugEnd)->firstOrFail();
        $products = $category->products()->with(['images', 'colors', 'category:id,name'])
            ->where('is_active', 1)
            ->paginate(15);
        // return $products;

        return view('user.collections', compact('products', 'breadCrumb'));
    }
}
