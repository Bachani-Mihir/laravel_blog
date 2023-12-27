<?php

use App\Http\Controllers\Admin\AdminSessionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\admin\AdminPostController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use App\Models\category;
use Database\Factories\CategoryFactory;
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

/* For Displaying All The Latest Posts */

Route::get('/posts',[PostController::class, 'view'])->middleware('auth');


/* Session Controller Routes */

Route::get('/',[RegisterController::class,'create'])->middleware('guest');

Route::post('/',[RegisterController::class,'store'])->middleware('guest');

Route::get('/login', [SessionController::class, 'view']);

Route::post('/login', [SessionController::class, 'valid']);

Route::get('/logout', [SessionController::class, 'destroy']);


/* Forgot Password Routes */

Route::get('/forgot-password',[UserController::class, 'forgot_password']);

Route::post('/forgot-password',[UserController::class, 'send_mail']);   // Used MailTrap

Route::get('/password-reset/{any?}', [UserController::class, 'verify_token'])
    ->where('any', '.*\bemail=([^&]+).*\btoken=([^&]+).*')
    ->name('password-reset');

Route::post('/update-password', [UserController::class, 'update_password']);


/* User Post Controller Routes */

Route::get('/home', [PostController::class,'view']);

Route::get('/posts', [PostController::class, 'filter_posts']);

Route::get('/posts/{slug}', [PostController::class, 'show_post']);


Route::middleware(['admin'])->group(function () {

/* Admin Session Controller Routes */

Route::get('/admin/login',[AdminSessionController::class,'view']);

Route::post('/admin/login',[AdminSessionController::class,'valid']);


/* Admin Post Controller Routes */


    Route::get('/admin/posts/create', [AdminPostController::class, 'create']);

    Route::post('/admin/posts/create', [AdminPostController::class, 'store']);

    Route::get('/admin/posts/{post_id}/edit', [AdminPostController::class, 'edit_post']);

    Route::patch('/admin/posts/{post_id}', [AdminPostController::class, 'update']);

    Route::delete('/admin/posts/{post_id}', [AdminPostController::class, 'destroy']);

    Route::get('/admin/posts', [AdminPostController::class, 'index'])->middleware('admin');

    Route::post('/admin/posts', [AdminPostController::class, 'store'])->middleware('admin');

    Route::get('/admin-home', [AdminPostController::class, 'view'])->middleware('admin');

});

