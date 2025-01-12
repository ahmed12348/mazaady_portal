<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        $admin = User::firstOrCreate([
            'email' => 'admin@company.com',
        ], [
            'name' => 'Admin User',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        // Create employee users
        $employees = User::factory(10)->create(); // Use factory for quick generation
        $departments = Department::all();

        foreach ($employees as $employee) {
            $employee->assignRole('employee');
            // Assign employee to 1-3 random departments
            $employee->departments()->attach($departments->random(rand(1, 3))->pluck('id')->toArray());
        }
    }
}
