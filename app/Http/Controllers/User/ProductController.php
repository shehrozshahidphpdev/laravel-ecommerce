<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
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
        $slugs = explode('/', $slug);

        $slug = end($slugs);

        $product = Product::with(['category', 'images', 'colors', 'tag', 'specifications'])
            ->where('slug', $slug)
            ->first();

        return view('user.show', compact('product'));


        // $breadCrumbs = [];

        // $breadcrumbs = [
        //     [
        //         'title' => ""
        //     ]
        // ]
    }
}
