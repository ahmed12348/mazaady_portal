<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function index()
    {
        $folders = auth()->user()->folders;  // Get the authenticated user's folders
        return response()->json($folders);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $folder = auth()->user()->folders()->create([
            'name' => $request->name,
        ]);
    
        return response()->json($folder, 201);  // Return created folder
    }
    
    public function show($folderId)
    {
        $folder = auth()->user()->folders()->findOrFail($folderId);
        return response()->json($folder);
    }
}
