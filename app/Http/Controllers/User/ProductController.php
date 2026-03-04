<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function quickView()
    {
        return response()->json(['message' => "reached"]);
        $id = $request->id;
        $product = Product::with(['category', 'images'])
            ->where('id', $id)
            ->get();
        return response()->json([
            'product' => $product
        ]);
    }
}
