<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'type',
        // 'visibility', // Assuming 'visibility' is a field for whether the note is private or public
        'folder_id',
        // 'user_id', // If you're associating the note with a user
        'pdf_url', // URL for the PDF note (if type is 'pdf')
        'is_shared' // To handle whether the note is shared or not
    ];
    // A note belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A note belongs to a folder
    public function folder()
    {
        return $this->belongsTo(Folder::class);
    
    }
}
