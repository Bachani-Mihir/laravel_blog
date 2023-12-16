<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PostController;
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

Route::get('/home', function () {
    return view('home');
});

// Route::get('/child', function () {
//     return view('/components/child');
// });

// Route::get('/child', function () {
//     return view('components.Parent');
// });

Route::get('/register',[RegisterController::class,'create'])->middleware('guest');

Route::post('/register',[RegisterController::class,'store'])->middleware('guest');

Route::post('/logout',[SessionController::class,'destroy'])->middleware('guest');

Route::get('/login', [SessionController::class, 'view']);
Route::post('/login', [SessionController::class, 'valid']);

// Route::get('/posts/{post}', function ($id) {
//     return view('post', [
//         'post' => posts::findOrFail($id),
//     ]);
// });
// Route::get('/posts', function () {
//     return view('posts.show');
// });

Route::get('/posts', [PostController::class, 'view']);

Route::get('/posts/{post:slug}', function (Post $post) {
    return view('post', [
        'post' => $post
    ]);
});

Route::get('/category/{category}', function (Category $category) {
    return view('post', [
        'post' => $category
    ]);
});
