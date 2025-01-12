<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }
    
    public function folders()
    {
        return $this->hasMany(Folder::class);
    }
    public function notes()
    {
        return $this->hasManyThrough(Note::class, Folder::class);
    }
    // Get the highest salary from the departments the employee works in
    public function highestSalary()
    {
        // Ensure 'departments' and their 'salary' are eagerly loaded
        $this->load('departments.salary'); // Eager load 'salary' with 'departments'

        // Get the highest salary from the user's departments
        return $this->departments->max(function ($department) {
            return $department->salary ? $department->salary->amount : 0;
        });
    }
    
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
