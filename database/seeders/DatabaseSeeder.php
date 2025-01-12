<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Salary;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SalarySeeder::class,
            RolePermissionSeeder::class, // Ensure roles are seeded first
            DepartmentSeeder::class,
            UserSeeder::class,
            // EmployeeDepartmentSeeder::class,
        ]);
    }
}
