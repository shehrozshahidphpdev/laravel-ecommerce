<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::paginate(10);
        return view('admin.brands.list', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'slug' => ['unique:brands,slug'],
        ], [
            'slug' => "The Brand Name has Already been taken",
        ]);

        try {
            Brand::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'is_active' => $request->status
            ]);
            Log::info("Brand Created Successfully");
            Session::flash('success', "Brand Created Successfully");
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error("Something Went Wrong", [
                'message' => $e->getMessage()
            ]);
            Session::flash('error', "Something Went Wrong");
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
        $brand = Brand::findOrFail($id);

        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'slug' => ['unique:brands,slug,' . $id],
        ], [
            'slug' => "The Brand Name has Already been taken",
        ]);

        try {
            Brand::where('id', $id)->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'is_active' => $request->status
            ]);
            Log::info("Brand Updated Successfully");
            Session::flash('success', "Brand Updated Successfully");
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error("Something Went Wrong", [
                'message' => $e->getMessage()
            ]);
            Session::flash('error', "Something Went Wrong");
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);

        if ($brand) {
            $brand->delete();
            Session::flash('success', 'Brand Deleted Successfully');
            return redirect()->back();
        } else {
            Session::flash('error', 'oops something went wrong');
            return redirect()->back();
        }
    }
}
