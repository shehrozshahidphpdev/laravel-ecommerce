<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\ProductTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('brand')
            ->with('category')
            ->with('tag')
            ->orderByDesc('id')
            ->paginate(10);
        // return $products;
        return view('admin.products.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();

        // return $categories;
        $tags = ProductTag::all();
        return view('admin.products.create', compact('categories', 'tags', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'category_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'min:3'],
            'slug' => ['nullable', 'string', 'unique:products,slug'],
            'short_description' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:2000'],
            'original_price' => ['required', 'numeric'],
            'discounted_price' => ['nullable', 'numeric'],
            'tag_id' => ['integer'],
            'sku' => ['required', 'min:5', 'string'],
            'quantity' => ['required', 'numeric'],
            'status' => ['integer'],
            'featured' => ['integer'],
            'sale' => ['integer'],
            'brand_id' => ['nullable', 'numeric']
        ]);

        try {
            Product::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'slug' => $request->slug ?? Str::slug($request->name),
                'short_description' => $request->short_description,
                'description' => $request->description,
                'original_price' => $request->original_price,
                'discounted_price' => $request->discounted_price,
                'tag_id' => $request->tag_id,
                'sku' => $request->sku,
                'quantity' => $request->quantity,
                'brand_id' => $request->brand_id,
                'on_sale' => $request->sale,
                'is_active' => $request->status,
                'is_featured' => $request->featured
            ]);

            Log::info('Product Created Successfully');
            Session::flash('success', 'Product Created Successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Product not created successfully ' . $e->getMessage());
            Session::flash('error', 'Something Went Wrong');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $tags = ProductTag::all();
        $brands = Brand::all();
        // dd($product);

        return view('admin.products.edit', compact('product', 'categories', 'tags', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd('here');
        $request->validate([
            'category_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'min:3'],
            'slug' => ['nullable', 'string', 'unique:products,slug,' . $id],
            'short_description' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:2000'],
            'original_price' => ['required', 'numeric'],
            'discounted_price' => ['nullable', 'numeric'],
            'tag_id' => ['integer'],
            'sku' => ['required', 'min:5', 'string'],
            'quantity' => ['required', 'numeric'],
            'status' => ['integer'],
            'featured' => ['integer'],
            'sale' => ['integer'],
            'brand_id' => ['nullable', 'numeric']
        ]);

        try {
            Product::where('id', $id)->update([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'slug' => $request->slug ?? Str::slug($request->name),
                'short_description' => $request->short_description,
                'description' => $request->description,
                'original_price' => $request->original_price,
                'discounted_price' => $request->discounted_price,
                'tag_id' => $request->tag_id,
                'sku' => $request->sku,
                'quantity' => $request->quantity,
                'brand_id' => $request->brand_id,
                'on_sale' => $request->sale,
                'is_active' => $request->status,
                'is_featured' => $request->featured
            ]);

            Log::info('Product Updated Successfully');
            Session::flash('success', 'Product Updated Successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Product not updated successfully ' . $e->getMessage());
            Session::flash('error', 'Something Went Wrong');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        Log::info('Product Deleted Successfully', [
            'product_id' => $id
        ]);

        Session::flash('success', "Product Deleted Successfully");
        return redirect()->back();
    }
}
