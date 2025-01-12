<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Salary;
use App\Models\User;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            ['name' => 'HR', 'salary_id' => Salary::where('name', 'Junior')->first()->id],
            ['name' => 'Engineering', 'salary_id' => Salary::where('name', 'Lead')->first()->id],
            ['name' => 'Sales', 'salary_id' => Salary::where('name', 'Mid-Level')->first()->id],
            ['name' => 'Marketing', 'salary_id' => Salary::where('name', 'Senior')->first()->id],
            ['name' => 'Finance', 'salary_id' => Salary::where('name', 'Mid-Level')->first()->id],
        ];

        foreach ($departments as $dept) {
            Department::firstOrCreate($dept);
        }
    }
}
