<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models;
use App\Models\Post;

class PostController extends Controller
{
    public function view()
    {
        $posts = Post::all();
     //   dd($posts);
        return view('components.posts', ['posts' => $posts]);
    }

}
