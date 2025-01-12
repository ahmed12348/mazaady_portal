<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Folder;
use App\Models\Note;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class FolderController extends Controller
{
    public function create(Request $request)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Get authenticated user
        $user = JWTAuth::user();

        // Create new folder for the authenticated user
        $folder = Folder::create([
            'name' => $request->name,
            'user_id' => $user->id,
        ]);

        // Return response
        return response()->json([
            'message' => 'Folder created successfully!',
            'folder' => $folder,
        ], 201);
    }

    // Get all Folders for authenticated user
    public function getAll()
    {
        $user = JWTAuth::user();

        // Get all folders that belong to the authenticated user
        $folders = $user->folders;

        // Return folders
        return response()->json([
            'folders' => $folders,
        ]);
    }

    // Get a specific Folder by ID
    public function getById($id)
    {
        $user = JWTAuth::user();

        // Find folder by ID and check if it belongs to the authenticated user
        $folder = $user->folders()->find($id);

        if (!$folder) {
            return response()->json([
                'error' => 'Folder not found or unauthorized',
            ], 404);
        }

        return response()->json([
            'folder' => $folder,
        ]);
    }

    // Update Folder
    public function update(Request $request, $id)
    {
        $user = JWTAuth::user();

        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Find folder by ID and check if it belongs to the authenticated user
        $folder = $user->folders()->find($id);

        if (!$folder) {
            return response()->json([
                'error' => 'Folder not found or unauthorized',
            ], 404);
        }

        // Update folder name
        $folder->name = $request->name;
        $folder->save();

        // Return response
        return response()->json([
            'message' => 'Folder updated successfully!',
            'folder' => $folder,
        ]);
    }

    // Delete Folder
    public function delete($id)
    {
        $user = JWTAuth::user();

        // Find folder by ID and check if it belongs to the authenticated user
        $folder = $user->folders()->find($id);

        if (!$folder) {
            return response()->json([
                'error' => 'Folder not found or unauthorized',
            ], 404);
        }

        // Delete folder
        $folder->delete();

        // Return response
        return response()->json([
            'message' => 'Folder deleted successfully!',
        ]);
    }

    // Create Note inside a Folder
    public function createNote(Request $request, $folder_id)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required_if:type,text|string',
            'pdf_url' => 'required_if:type,pdf|url',
            'type' => 'required|in:text,pdf',
            // 'visibility' => 'required|in:private,public',
        ]);

        $user = JWTAuth::user();
        $folder = $user->folders()->find($folder_id);

        if (!$folder) {
            return response()->json(['error' => 'Folder not found'], 404);
        }

        $note = new Note([
            'title' => $request->title,
            'body' => $request->body,
            'type' => $request->type,
            // 'visibility' => $request->visibility,
            'pdf_url' => $request->pdf_url,
            'folder_id' => $folder_id,
            // 'user_id' => $user->id,
        ]);

        $note->save();

        return response()->json([
            'message' => 'Note created successfully!',
            'note' => $note,
        ], 201);
    }
}

