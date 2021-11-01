<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;

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

Route::prefix('v1')->group(function() {
    // auth
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::middleware('auth:sanctum')->group(function() {
        // todo
        Route::get('todo', [TodoController::class, 'index'])->name('todo');
        Route::get('todo/{id}', [TodoController::class, 'show'])->name('todo-show');
        Route::put('todo/{id}', [TodoController::class, 'update'])->name('todo-update');
        Route::delete('todo/{id}', [TodoController::class, 'destroy'])->name('todo-destroy');
        Route::post('todo/create', [TodoController::class, 'store'])->name('todo-store');
        // auth 
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });
});