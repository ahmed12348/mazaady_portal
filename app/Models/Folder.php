<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);  // A folder belongs to a user
    }

    public function notes()
    {
        return $this->hasMany(Note::class);  // A folder can have many notes
    }
}
