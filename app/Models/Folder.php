<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    protected $fillable = ['name','user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A folder has many notes
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
