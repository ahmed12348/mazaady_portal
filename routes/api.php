<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\NoteController;
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
Route::middleware('auth:sanctum')->group(function () {
    Route::get('folders', [FolderController::class, 'index']); // List all folders
    Route::post('folders', [FolderController::class, 'store']); // Create a new folder
    Route::get('folders/{folder}', [FolderController::class, 'show']); // Show a specific folder

    // Note Routes
    Route::post('folders/{folder}/notes', [NoteController::class, 'store']); // Create a new note
    Route::get('notes/{note}', [NoteController::class, 'show']); // Show a specific note
});