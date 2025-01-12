<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Salary;

class SalarySeeder extends Seeder
{ 
    public function run()
    {
        $salaries = [
            ['name' => 'Junior', 'amount' => 5000],
            ['name' => 'Mid-Level', 'amount' => 8000],
            ['name' => 'Senior', 'amount' => 12000],
            ['name' => 'Lead', 'amount' => 15000],
        ];

        foreach ($salaries as $salary) {
            Salary::firstOrCreate($salary);
        }
    }
}
