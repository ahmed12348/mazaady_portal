<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = ['name', 'salary_id'];


    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }

    public function employees()
    {
        return $this->belongsToMany(User::class);
    }
 
}
