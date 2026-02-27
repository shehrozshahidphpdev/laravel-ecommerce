<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Specification;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SpecificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Specification::orderByDesc('id')->paginate(10);
        return view(
            'admin.specifications.list',
            [
                'labels' => $labels
            ]
        );
    }

    public function search(Request $request)
    {
        $query = $request->search;
        if (empty($query)) {
            // $labels = Specification::paginate(10);
            $labels = Specification::all();
            return response()->json([
                'status' => true,
                'labels' => $labels,
                'message' => 'more thn two characters is required',
            ], 200);
        }

        $labels = Specification::where('label', 'LIKE', "%$query%")
            ->get();
        return response()->json([
            'status' => true,
            'message' => 'data fetched successfully',
            'labels' => $labels,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(view: 'admin.specifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'label' => ['required']
        ]);
        try {
            foreach ($request->label as $label) {
                Specification::create([
                    'label' => $label
                ]);
            }
            Log::info('specifications labels created successfully');
            Session::flash('success', "Labels Created Successfully");
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error("Something Went Wrong", [
                'error' => $e->getMessage()
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
        $label = Specification::findOrFail($id);
        return view('admin.specifications.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'label' => ['required']
        ]);
        try {
            $specification = Specification::findOrFail($id);
            $specification->where('id', $id)->update([
                'label' => $request->label[0]
            ]);
            Log::info('Specification Updated Successfully');
            Session::flash('success', "Specification Updated Successfully");
            return redirect()->route('specifications.index');
        } catch (\Exception $e) {
            Log::error("Something Went Wrong", [
                'error' => $e->getMessage()
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
        $specfication = Specification::findOrFail($id);
        $specfication->delete();
        Log::info("Specification Deleted Successfully");
        Session::flash('success', 'Specification Deleted Successfully');
        return redirect()->back();
    }
}
