<?php

namespace App\Http\Controllers\User;

use App\Helpers\MyHelper;
use App\Http\Controllers\Controller;
use App\Models\User\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with(['product.images'])
            ->where('customer_id', Auth::guard('customer')->id())
            ->get();

        return view('user.wishlist', [
            'wishlists' => $wishlists
        ]);
    }
    public function store(Request $request)
    {
        if (!MyHelper::customerCheck()) {
            return response()->json([
                'status' => false,
                'message' => "Please Login First"
            ]);
        }

        $wishlist = Session::get('wishlist', []);


        $productId = $request->productId;
        $productExists = Wishlist::where('product_id', $productId)
            ->where('customer_id', auth('customer')->id())
            ->exists();
        if ($productExists) {
            return response()->json([
                'status' => false,
                'message' => "Product is already in your wishlist"
            ]);
        }

        $wishlist = Wishlist::create([
            'product_id' => $productId,
            'customer_id' => auth('customer')->id()
        ]);

        if ($wishlist) {
            return response()->json([
                'status' => true,
                'message' => "added to wishlist successfully",
                'data' => $wishlist,
                'count' => Wishlist::where('customer_id', auth('customer')->id())
                    ->count('product_id')
            ], 201);
        }
    }

    public function destroy(string $id)
    {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();
        return redirect()->back()->with('success', "wish list has been updated");
    }
}
