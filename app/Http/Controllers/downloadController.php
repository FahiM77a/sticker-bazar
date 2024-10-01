<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class downloadController extends Controller
{
    //download
    function onDownload($tablePath,$path) {
        return Storage::download($tablePath."/".$path);
    }

    function onSelectFileList(Request $request) {
        // $result = DB::table('myFiles')->get();
        // return response()->json($result);

        $query = $request->input('search'); // Get the search query

        if ($query) {
            // Filter files by title if a search query is provided
            $result = DB::table('myFiles')
                ->where('title', 'LIKE', "%{$query}%")
                ->get();
        } else {
            // Return all files if no search query is provided
            $result = DB::table('myFiles')->get();
        }

        return response()->json($result);
    }
}
