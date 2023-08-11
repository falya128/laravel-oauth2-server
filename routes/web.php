<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/login', fn () => view('login'))->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
});

Route::middleware(['auth:web'])->group(function () {
    // View の表示
    Route::get('/', fn () => view('app'));
    Route::get('/user/{path?}', fn () => view('app'))->where('path', 'edit');

    // Controller の呼び出し
    Route::post('/user', [App\Http\Controllers\UserController::class, 'update']);
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
});
