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

Route::get('/posts',[PostController::class, 'view'])->middleware('auth');

// Route::get('/child', function () {
//     return view('/components/child');
// });

// Route::get('/child', function () {
//     return view('components.Parent');
// });

Route::get('/register',[RegisterController::class,'create'])->middleware('guest');

Route::post('/register',[RegisterController::class,'store'])->middleware('guest');

Route::get('/logout', [SessionController::class, 'destroy']);

Route::get('/login', [SessionController::class, 'view']);
Route::post('/login', [SessionController::class, 'valid']);

Route::get('/forgot-password',[UserController::class, 'forgot_password']);

Route::post('/forgot-password',[UserController::class, 'send_mail']);   // for testing purpose only

//Route::post('/verify-user', [UserController::class,'verify_user']);
Route::post('/change-password', [UserController::class, 'change_password']);
//Route::post('/change-password', [UserController::class, 'change_password']);
Route::post('/update-password', [UserController::class, 'update_password']);
// Route::get('/posts/{post}', function ($id) {
//     return view('post', [
//         'post' => posts::findOrFail($id),
//     ]);
// });
// Route::get('/posts', function () {
//     return view('posts.show');
// });

Route::get('/posts', [PostController::class, 'view']);

Route::get('/posts/{slug}', [PostController::class, 'show_post']);

Route::get('/category/{category_id}',[PostController::class, 'show_post_by_category']);

Route::get('author/{author_id}/category/{category_id}',[PostController::class, 'show_post_by_author_category']);

Route::get('/author/{author_id}',[PostController::class,'filter_posts_by_author']);

/* Route::get('/category/{category}', function (Category $category) {
    return view('post', [
        'post' => $category
    ]);
}); */

// Admin Routes
Route::get('/admin/login',[AdminSessionController::class,'view']);

Route::post('/admin/login',[AdminSessionController::class,'valid']);

Route::get('/admin/posts/create',[AdminPostController::class,'create'] );
Route::post('/admin/posts/create',[AdminPostController::class,'store']);

Route::get('/admin/posts/{post_id}/edit',[AdminPostController::class,'edit_post']);
Route::patch('/admin/posts/{post_id}',[AdminPostController::class,'update']);
Route::delete('/admin/posts/{post_id}',[AdminPostController::class,'destroy']);

Route::get('/admin/posts',[AdminPostController::class,'index'])->middleware('admin');

Route::post('/admin/posts',[AdminPostController::class,'store'])->middleware('admin');

Route::get('/admin-home',[AdminPostController::class,'view'])->middleware('admin');



