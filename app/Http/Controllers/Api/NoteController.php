<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    // 1. Create a new note
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:text,pdf',
            'body' => 'required_if:type,text|string|nullable',
            'pdf_url' => 'required_if:type,pdf|url|nullable',
            'is_shared' => 'boolean',
            'folder_id' => 'required|exists:folders,id',
        ]);

        $note = Note::create([
            'title' => $request->title,
            'type' => $request->type,
            'body' => $request->type === 'text' ? $request->body : null,
            'pdf_url' => $request->type === 'pdf' ? $request->pdf_url : null,
            'is_shared' => $request->is_shared ?? false,
            'folder_id' => $request->folder_id,
        ]);

        return response()->json([
            'message' => 'Note created successfully!',
            'note' => $note,
        ], 201);
    }

    // 2. Retrieve all notes (considering visibility)
    public function getAll(Request $request)
    {
        $user = $request->user();

        $notes = Note::where(function ($query) use ($user) {
            $query->where('is_shared', true); // Public notes
            if ($user) {
                $query->orWhere('folder_id', $user->id); // Private notes for the logged-in user
            }
        })->get();

        return response()->json([
            'message' => 'Notes retrieved successfully!',
            'notes' => $notes,
        ]);
    }

    // 3. Retrieve a single note by ID (with visibility checks)
    public function getById(Request $request, $id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        // Check if the note is private and belongs to the authenticated user
        if (!$note->is_shared && $request->user()->id !== $note->folder_id) {
            return response()->json(['message' => 'Unauthorized to view this note'], 403);
        }

        return response()->json([
            'message' => 'Note retrieved successfully!',
            'note' => $note,
        ]);
    }

    // 4. Update a note
    public function update(Request $request, $id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|in:text,pdf',
            'body' => 'required_if:type,text|string|nullable',
            'pdf_url' => 'required_if:type,pdf|url|nullable',
            'is_shared' => 'boolean',
            'folder_id' => 'exists:folders,id',
        ]);

        // Ensure only the owner can update private notes
        if (!$note->is_shared && $request->user()->id !== $note->folder_id) {
            return response()->json(['message' => 'Unauthorized to update this note'], 403);
        }

        $note->update($request->only(['title', 'type', 'body', 'pdf_url', 'is_shared', 'folder_id']));

        return response()->json([
            'message' => 'Note updated successfully!',
            'note' => $note,
        ]);
    }

    // 5. Delete a note
    public function delete(Request $request, $id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        // Ensure only the owner can delete private notes
        if (!$note->is_shared && $request->user()->id !== $note->folder_id) {
            return response()->json(['message' => 'Unauthorized to delete this note'], 403);
        }

        $note->delete();

        return response()->json(['message' => 'Note deleted successfully!']);
    }
}
