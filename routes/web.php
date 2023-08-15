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
    Route::get('/', fn () => view('app'));
    Route::get('/user/{path?}', fn () => view('app'))->where('path', 'edit');

    Route::post('/user', [App\Http\Controllers\UserController::class, 'update']);
});

Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout']);


/**
 * Laravel Passport
 */

Route::group([
    'as' => 'passport.',
    'prefix' => config('passport.path', 'oauth'),
    'namespace' => '\Laravel\Passport\Http\Controllers',
], function () {
    Route::get('/authorize', [
        'uses' => 'AuthorizationController@authorize',
        'as' => 'authorizations.authorize',
        'middleware' => 'web',
    ]);
    Route::post('/token', [
        'uses' => 'AccessTokenController@issueToken',
        'as' => 'token',
        'middleware' => 'throttle',
    ]);
});
