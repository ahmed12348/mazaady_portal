<?php

use App\Http\Controllers\Api\AuthController as ApiAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FolderController;
use App\Http\Controllers\Api\NoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::middleware(['auth:api'])->group(function () {

   // Create a folder (Authenticated users only)
    Route::post('/folders', [FolderController::class, 'create']); 

    // Get all folders of the authenticated user
    Route::get('/folders', [FolderController::class, 'getAll']); 

    // Get a specific folder by ID
    Route::get('/folders/{id}', [FolderController::class, 'getById']); 

    // Update a folder's details by ID
    Route::put('/folders/{id}', [FolderController::class, 'update']); 

    // Delete a folder by ID
    Route::delete('/folders/{id}', [FolderController::class, 'delete']);


    Route::post('/notes', [NoteController::class, 'create']); // Create a note
    Route::get('/notes', [NoteController::class, 'getAll']); // Get all notes (shared and owned)
    Route::get('/notes/{id}', [NoteController::class, 'getById']); // Get a specific note
    Route::put('/notes/{id}', [NoteController::class, 'update']); // Update a specific note
    Route::delete('/notes/{id}', [NoteController::class, 'delete']);
});