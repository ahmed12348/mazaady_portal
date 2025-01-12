<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function store(Request $request, $folderId)
{
    $folder = auth()->user()->folders()->findOrFail($folderId);

    $request->validate([
        'title' => 'required|string|max:255',
        'type' => 'required|in:text,pdf',
        'body' => 'nullable|string',
        'pdf_url' => 'nullable|url',
        'is_shared' => 'boolean',
    ]);

    $note = $folder->notes()->create([
        'title' => $request->title,
        'type' => $request->type,
        'body' => $request->body,
        'pdf_url' => $request->pdf_url,
        'is_shared' => $request->is_shared,
    ]);

    return response()->json($note, 201);
}

public function show($noteId)
{
    $note = Note::findOrFail($noteId);

    if (!$note->is_shared && $note->folder->user_id !== auth()->id()) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    return response()->json($note);
}

}
