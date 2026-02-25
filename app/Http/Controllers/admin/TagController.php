<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Color;
use App\Models\Admin\ProductTag;
use Illuminate\Container\Attributes\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = ProductTag::with('color')->paginate(10);
        // return $tags;

        return view('admin.tags.list', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colors = Color::all();
        return view('admin.tags.create', compact('colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'color_id' => ['required', 'integer']
        ], [
            'name' => "The tag name field is required",
            'color_id' => "Please Select a color first"
        ]);

        try {
            ProductTag::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'color_id' => $request->color_id
            ]);
            Log::info("Tag created Successfully");
            Session::flash('success', 'Tag created Successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Something went wrong', ['message' => $e->getMessage()]);
            Session::flash('error', 'Something went wrong');
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
        $colors = Color::all();
        $tag = ProductTag::with('color')->findOrFail($id);
        $previousColor = $tag->color->hex_code;

        return view(
            'admin.tags.edit',
            compact(
                'colors',
                'tag',
                'previousColor'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'color_id' => ['required', 'integer']
        ], [
            'name' => "The tag name field is required",
            'color_id' => "Please Select a color first"
        ]);

        try {
            ProductTag::where('id', $id)->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'color_id' => $request->color_id
            ]);
            Log::info("Tag updated Successfully");
            Session::flash('success', 'Tag updated Successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Something went wrong', ['message' => $e->getMessage()]);
            Session::flash('error', 'Something went wrong');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = ProductTag::findOrFail($id);

        if ($tag) {
            $tag->delete();

            Log::info(message: "tag deleted successfully");
            Session::flash('success', 'tag deleted successfully');
            return redirect()->back();
        } else {
            Log::info(message: "something went wrong");
            Session::flash('error', 'something went wrong');
            return redirect()->back();
        }
    }
}
