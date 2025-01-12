<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
  
        
    public function index(Request $request)
    {
       
        $n = $request->input('n', 1);

        
        $topSalaries = User::with('departments.salary')
            ->get()
            ->flatMap(function ($user) {
                return $user->departments->pluck('salary.amount');
            })
            ->unique()
            ->sortDesc()
            ->values();

        // Get the N-th highest salary (handle if N is out of bounds)
        $nthSalary = $topSalaries->get($n - 1);

        if (!$nthSalary) {
            return view('admin.employees.index', [
                'employees' => collect(), // Empty collection if no N-th salary found
                'nthSalary' => null,
                'n' => $n
            ]);
        }

        // Fetch employees whose highest salary matches the N-th highest salary
        $employees = User::whereHas('departments.salary', function ($query) use ($nthSalary) {
            $query->where('amount', $nthSalary);
        })->get();

        // Pass data to the view
        return view('admin.employees.index', [
            'employees' => $employees,
            'nthSalary' => $nthSalary,
            'n' => $n
        ]);
    }
    
    
    

    

}
