<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use App\Models\Admin\ProductImage;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function index()
    {
        // Session::forget('cart');
        $cartProducts = Session::get('cart', []);
        return view('user.cart', compact('cartProducts'));
    }
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->id);

        $productImage = ProductImage::where('product_id', $request->id)->first();

        if ($request->has('quantity')) {
            $productQty = $request->quantity;
        }

        $cart = Session::get('cart', []);

        foreach ($cart as $key => $cartItem) {

            if ($cartItem['productId'] == $request->id) {

                $qty = $request->has('quantity') ? $productQty : 1;

                $cart[$key]['qty'] += $qty;

                Session::put('cart', $cart);

                return response()->json([
                    'status' => true,
                    'message' => "Product quantity increased successfully",
                    'cartItems' => $cart
                ], 200);
            }
        }

        $cart[$request->id] = [
            'productId' => $request->id,
            'productName' => $product->name,
            'productImage' => $productImage->image_path ?? null,
            'originalPrice' => $product->original_price,
            'discountedPrice' => $product->discounted_price ?? null,
            'qty' => $productQty ?? 1
        ];

        Session::put('cart', $cart);

        return response()->json([
            'status' => true,
            'message' => "Product added to cart",
            'cartItems' => $cart
        ], 200);
    }

    public function storeWishListItemToCart(Request $request)
    {
        $productId = $request->id;
        $productQty = $request->qty;

        $cart = Session::get('cart', []);

        // increase quantity if the product is already in the cart 
        foreach ($cart as $key => $cartItem) {
            if ($key == $productId) {
                $cart[$key]['qty'] += ($productQty == 1 ? 1 : $productQty);
                Session::put('cart', $cart);

                return response()->json([
                    'status' => true,
                    'message' => "Cart updated successfully",
                ], 200);
            }
        }

        $product = Product::findOrFail($productId);
        $productImage = ProductImage::where('product_id', $product->id)->first();

        $cart[$productId] = [
            'productId' => $productId,
            'productName' => $product->name,
            'productImage' => $productImage->image_path ?? null,
            'originalPrice' => $product->original_price ?? null,
            'discountedPrice' => $product->discounted_price ?? null,
            'qty' => $productQty ?? 1
        ];

        Session::put('cart', $cart);

        return response()->json([
            'status' => true,
            'message' => "Cart updated suuccessfully",
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

    public function update(Request $request)
    {
        $cart = Session::get('cart');

        foreach ($cart as $key => $cartItem) {
            foreach ($request->items as $item) {
                if ($item['id'] == $key) {
                    $cart[$key]['qty'] = $item['qty'];
                    Session::put('cart', $cart);
                }
            }
        }

        return response()->json([
            'status' => true,
            'message' => "Cart has been updated",
        ], 201);
    }
}
