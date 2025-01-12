<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    public function folder()
    {
        return $this->belongsTo(Folder::class);  // A note belongs to a folder
    }
}
