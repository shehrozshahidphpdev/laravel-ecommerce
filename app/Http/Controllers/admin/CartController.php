<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use App\Models\Admin\ProductImage;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->id);

        $productImage = ProductImage::where('product_id', $request->id)->first();

        $cart = Session::get('cart', []);

        if (!empty($cart)) {

            foreach ($cart as $key => $cartItem) {

                if ($cartItem['productId'] == $request->id) {

                    $cart[$key]['qty']++;

                    Session::put('cart', $cart);

                    return response()->json([
                        'status' => true,
                        'message' => "Product quantity increased successfully",
                        'cartItems' => $cart
                    ], 200);
                }
            }
        }

        $cart[$request->id] = [
            'productId' => $request->id,
            'productName' => $product->name,
            'productImage' => $productImage->image_path ?? null,
            'originalPrice' => $product->original_price,
            'discountedPrice' => $product->discounted_price,
            'qty' => 1
        ];

        Session::put('cart', $cart);

        return response()->json([
            'status' => true,
            'message' => "Product added to cart",
            'cartItems' => $cart
        ], 200);
    }

    public function deleteFromCart(Request $request)
    {
        $cart = Session::get('cart');

        if (!empty($cart)) {

            if (array_key_exists($request->id, $cart)) {
                unset($cart[$request->id]);
                Session::put('cart', $cart);

                return response()->json([
                    'status' => true,
                    'message' => "Product removed from cart successfully",
                    'cartItems' => $cart,
                    'removedProductId' => $request->id,
                ], 200);
            }

            return response()->json([
                'status' => false,
                'message' => "Product dont removed",
                'cartItems' => $cart,
                'removedProductId' => $request->id,
            ], 500);
        }
    }
}
