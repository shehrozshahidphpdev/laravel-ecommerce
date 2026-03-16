<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Color;
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
            'status' => true,
            'message' => 'Product fetched successfully',
            'product' => $product
        ]);
    }

    public function show(string $slug)
    {
        $data['breadcrumbs'] = [];

        $slugs = explode('/', $slug);

        $productSlug = array_pop($slugs);

        foreach ($slugs as $slug) {
            $data['breadcrumbs'][] = Category::select('name', 'slug')
                ->where('slug', $slug)->first();
        }

        $product =  Product::select('name')->where('slug', $productSlug)->first();
        $data['breadcrumbs'][] = [
            'name' => $product->name
        ];

        $product = Product::with(['category:id,name', 'images:id,image_path,product_id', 'colors:id,color', 'tag', 'specifications'])
            ->slug($productSlug)
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

        $categoryIds = $category::getChildrenCategories($category)
            ->pluck('id')
            ->prepend($category->id);

        $query = Product::whereIn('category_id', $categoryIds)
            ->with(['images', 'colors', 'category:id,name,slug,parent_id', 'brand', 'tag.color'])
            ->where('is_active', 1);

        if (request('min_price')) {
            $query->where('original_price', '>=', request('min_price'));
        }
        if (request('max_price')) {
            $query->where('original_price', '<=', request('max_price'));
        }

        if (request('on_sale')) {
            $query->whereNotNull('discounted_price');
        }

        if (request('in_stock')) {
            $query->where('quantity', '>', 0);
        }

        if (request('brands') && is_array(request('brands'))) {
            $query->whereIn('brand_id', request('brands'));
        }

        if (request('categories') && is_array(request('categories'))) {
            $query->whereIn('category_id', request('categories'));
        }

        if (request('colors') && is_array(request('colors'))) {
            $query->whereHas('colors', function ($q) {
                $q->whereIn('colors.id', request('colors'));
            });
        }

        match (request('sort')) {
            'price_asc'  => $query->orderBy('original_price', 'asc'),
            'price_desc' => $query->orderBy('original_price', 'desc'),
            'newest'     => $query->orderBy('created_at', 'desc'),
            'on_sale'    => $query->orderByRaw('discounted_price IS NULL ASC'),
            default      => $query->orderBy('created_at', 'desc'),
        };

        $products = $query->paginate(15)->withQueryString(); // withQueryString keeps filters in pagination links

        $categoryFilters = Category::getChildrenCategories($category);

        $brands = Brand::whereHas('products', function ($q) use ($category) {
            $q->where('category_id', $category->id)->where('is_active', 1);
        })->get();

        $colors = Color::getProductColorsWithCount($category->id);

        return view('user.collections', compact(
            'products',
            'breadCrumb',
            'colors',
            'categoryFilters',
            'brands'
        ));
    }
}
