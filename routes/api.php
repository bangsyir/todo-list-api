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
        Route::get('todo/logs/views', [TodoController::class, 'getLogs'])->name('todo-logs');
        Route::put('todo/set-reminder/{id}', [TodoController::class, 'setReminder'])->name('todo-setReminder');
        // auth 
        Route::get('user', [AuthController::class, 'getUser'])->name('user');
        Route::put('plan/update', [AuthController::class, 'updatePlan'])->name('update-plan');
        Route::put('logout', [AuthController::class, 'logout'])->name('logout');
    });
});
