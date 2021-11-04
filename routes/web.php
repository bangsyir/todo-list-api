<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
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

Route::get('/', function() {
    return redirect()->route('login-view');
});

Route::get('/todos', function () {
    return view('todos.index');
});
Route::get('/login', [AuthController::class, 'getLogin'])->name('login-view');
Route::get('/register', [AuthController::class, 'getRegister'])->name('register-view');
Route::get('/logs', [TodoController::class, 'getLogs'])->name('todos-log');