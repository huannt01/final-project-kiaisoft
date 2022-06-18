<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($route) {
    Route::post('/register', [AuthController::class, 'register'])->name('user.register');
    Route::get('verify-email/{id}/{hash}', [AuthController::class, 'verify'])->name('verification.verify');
    Route::post('/login', [AuthController::class, 'login'])->name('user.login');
    Route::get('/profile', [AuthController::class, 'profile'])->name('user.profile');
    Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');
});
