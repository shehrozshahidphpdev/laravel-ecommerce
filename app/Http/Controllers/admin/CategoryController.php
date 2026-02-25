<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MyHelper;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories  = Category::with('parent')
            ->ordered()
            ->paginate(10);
        return view('admin.categories.list', [
            'categories' => $categories
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->search;

        if (empty($query) || strlen($query) < 2) {
            $categories  = Category::with('parent')
                ->ordered()
                ->paginate(10);
        } else {
            $categories = Category::where('name', 'like', "%{$query}%")
                ->orWhere('slug', 'like', "%{$query}%")
                ->orWhere('parent_id', 'like', "%{$query}%")
                ->orWhere('tags', 'like', "%{$query}%")
                ->get();
        }
        return response()->json([
            'status' => true,
            'categories' => $categories,
            'message' => 'results sent successfully'
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.categories.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'slug' => 'string|nullable|max:50|unique:categories',
            'image' => ['mimes:png,jpg,webp', 'max:5000'],
            'icon' => ['mimes:png,jpg,webp,svg', 'max:5000']
        ]);
        $tags = $request->tags;

        $tags = array_filter($tags);

        try {
            $imagePath = $request->file('image') ? MyHelper::uploadFile($request->file('image')) : null;
            $iconPath = $request->file('icon') ? MyHelper::uploadFile($request->file('icon')) : null;
            Category::create([
                'name' => $request->input('name'),
                'slug' => $request->slug ?? Str::slug($request->name),
                'tags' => empty($tags) ? null : $tags,
                'image' => $imagePath,
                'category_icon' => $iconPath,
                'parent_id' => $request->parent_id ?? null,
            ]);

            Log::info('Category Created Succesfully', ['category_info' => Category::latest()->first()]);
            Session::flash('success', 'Category Created Successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Something Went Wrong' . $e->getMessage());
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
        $categories = Category::all();
        $category = Category::findOrFail($id);
        // return $category;
        if ($category) {
            return view('admin.categories.edit', [
                'categories' => $categories,
                'category' => $category
            ]);
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'slug' => 'string|nullable|max:50|unique:categories,slug,' . $category->id,
            'image' => ['mimes:png,jpg,webp', 'max:5000'],
            'icon' => ['mimes:png,jpg,webp,svg', 'max:5000']
        ]);

        try {
            if ($request->file('image')) {
                MyHelper::removeFile($category->image);
                Log::info('image removed sucessfully from storage disk', [
                    'id' => $category->id
                ]);
            }

            if ($request->file('icon')) {
                MyHelper::removeFile($category->category_icon);
                Log::info('category Icon removed sucessfully from storage disk', [
                    'id' => $category->id
                ]);
            }

            $imagePath = $request->file('image') ? MyHelper::uploadFile($request->file('image')) : $category->image;
            $iconPath = $request->file('icon') ? MyHelper::uploadFile($request->file('icon')) : $category->category_icon;
            Category::where('id', $id)->update([
                'name' => $request->input('name'),
                'slug' => $request->slug ?? Str::slug($request->name),
                'tags' => $request->tags,
                'image' => $imagePath,
                'category_icon' => $iconPath,
                'parent_id' => $request->parent_id ?? null,
            ]);

            Log::info('Category updated Succesfully', ['category_id' => $category->id]);
            Session::flash('success', 'Category Updated Successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Something Went Wrong' . $e->getMessage());
            Session::flash('error', 'Something Went Wrong');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (isset($category->image)) {
            MyHelper::removeFile($category->image);
            Log::info('image removed successfully from the storage disk', [
                'category_id' => $id
            ]);
        }

        if (isset($category->category_icon)) {
            MyHelper::removeFile($category->category_icon);
            Log::info('category icon removed successfully from the storage disk', [
                'cat_id' => $id
            ]);
        }
        if ($category->delete($category)) {
            Log::info('Category deleted successfully', [
                'category_id' => $id
            ]);
            return redirect()->back()->with('success', "Category Deleted Successsfully");
        } else {
            Log::error('Category dont deleted', [
                'category_id' => $id
            ]);
            return redirect()->back()->with('error', "Something went wrong");
        }
    }
}
