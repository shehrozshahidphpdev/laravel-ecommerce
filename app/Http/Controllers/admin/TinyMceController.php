<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TinyMceController extends Controller
{
    public function upload(Request $request)
    {
        // return response()->json([
        //     'msg' => 'reached'
        // ]);

        try {
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
            ]);

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destination = 'editor-images';

            // Store the file
            $path = $file->storeAs($destination, $fileName, 'public');

            // Generate full URL
            $fullUrl = asset('storage/' . $path);

            // Log for debugging
            Log::info('Image uploaded successfully', [
                'path' => $path,
                'url' => $fullUrl
            ]);

            // Return the location that TinyMCE expects
            return response()->json([
                'location' => $fullUrl
            ], 200);
        } catch (\Exception $e) {
            Log::error('Image upload failed: ' . $e->getMessage());

            return response()->json([
                'error' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
