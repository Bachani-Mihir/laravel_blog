<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
|
;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

|
*/

Route::get('/', [RegisterController::class, 'create']);

Route::get('/login', [SessionController::class, 'view'])->name('login');

/* Forgot Password Routes */

Route::get('/forgot-password', [UserController::class, 'forgot_password']);

Route::get('/password-reset/{any?}', [UserController::class, 'verify_token'])
    ->where('any', '.*\bemail=([^&]+).*\btoken=([^&]+).*')
    ->name('password-reset');
