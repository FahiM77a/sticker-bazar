<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import the DB facade

class UploadController extends Controller
{
    //file upload method
    function fileUpload(Request $request) {

        // Validate the request
        $request->validate([
            'FileKey' => 'required|file|mimes:jpg,jpeg,png,pdf,zip,webp|max:10240', // Adjust as needed
            'title' => 'required|string|max:255',
        ]);

         // Check if the file is present
        if (!$request->hasFile('FileKey')) {
            return response()->json(['success' => false, 'message' => 'No file was uploaded.']);
        }

        // Try to store the uploaded file
        try {
            $path = $request->file('FileKey')->store('AllFiles');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'File upload failed: ' . $e->getMessage()]);
        }

        // Insert the title and file path into the myFiles table
        DB::table('myFiles')->insert([
            'title' => $request->input('title'),
            'file_path' => $path,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'File uploaded successfully!',
            'file_path' => $path,
            'title' => $request->input('title'), // Return the title for confirmation
        ]);

    }
}
