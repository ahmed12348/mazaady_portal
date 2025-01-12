<?php

use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EmployeeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


require __DIR__.'/auth.php';
Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    // Route::get('/dashboard', [UserController::class, 'index'])->name('admin.dashboard');
    // Route::get('/employees', [UserController::class, 'index'])->name('admin.employees.index');
    // Route::get('/employees2', [UserController::class, 'index2'])->name('admin.employees.index2');
    Route::get('employees', [UserController::class, 'index'])->name('employees.index');
    Route::get('departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::post('/employees/top-salaries', [UserController::class, 'getTopNSalaries'])->name('employees.top-salaries');
});




