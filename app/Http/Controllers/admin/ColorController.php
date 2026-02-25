<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = Color::paginate(10);
        return view('admin.colors.list', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.colors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'color' => ['required', 'string', 'min:3'],
            'hex_code' => ['required', 'string', 'regex:^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$^']
        ]);

        try {
            Color::create([
                'color' => $request->color,
                'hex_code' => $request->hex_code,
            ]);
            Session::flash('success', 'Color created Successfully!');
            Log::info('Color created Successfully!');
            return redirect()->back();
        } catch (\Exception) {
            Session::flash('success', 'Somethig went wrong');
            Log::error('Somethig went wrong');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'color' => ['required', 'string', 'min:3'],
            'hex_code' => ['required', 'string', 'regex:^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$']
        ]);

        try {
            Color::where('id', $id)->update([
                'color' => $request->color,
                'hex_code' => $request->hex_code,
            ]);
            Session::flash('success', 'Color updated Successfully!');
            Log::info('Color updated Successfully!');
            return redirect()->back();
        } catch (\Exception) {
            Session::flash('success', 'Somethig went wrong');
            Log::error('Somethig went wrong');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $color = Color::findOrFail($id);
        if ($color) {
            $color->delete();
            Session::flash('success', 'Color Deleted Successfully');
            Log::info("Color Deleted Successfully");
            return redirect()->back();
        } else {
            Session::flash('success', 'Something went wrong');
            Log::info("Something went wrong");
        }
    }
}
