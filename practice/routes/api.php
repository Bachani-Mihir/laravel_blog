<?php

use App\Http\Controllers\admin\AdminPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
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

Route::post('/', [RegisterController::class, 'store']);
Route::post('/login', [SessionController::class, 'valid']);

Route::get('/home', [PostController::class, 'view'])->middleware('auth:sanctum');
Route::get('/posts', [PostController::class, 'filter_posts'])->middleware('auth:sanctum');
Route::get('/posts/{slug}', [PostController::class, 'show_post'])->middleware('auth:sanctum');
Route::post('/forgot-password', [UserController::class, 'send_mail']);   // Used MailTrap
Route::post('/update-password', [UserController::class, 'update_password'])->name('user.update_password');
Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth:sanctum')->name('user.logout');

Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
    Route::get('/admin-home', [AdminPostController::class, 'view']);
    Route::get('/posts', [AdminPostController::class, 'index']);
    Route::post('/posts/create', [AdminPostController::class, 'store'])->name('admin.create');
    Route::patch('/posts/{post_id}', [AdminPostController::class, 'update'])->name('admin.update_post');
    Route::delete('/posts/{post_id}', [AdminPostController::class, 'destroy'])->name('admin.delete_post');
});

Route::get('admin/posts/create', [AdminPostController::class, 'create'])->middleware(['admin', 'web']);
Route::get('admin/posts/{post_id}/edit', [AdminPostController::class, 'edit_post'])->middleware(['admin', 'web']);
