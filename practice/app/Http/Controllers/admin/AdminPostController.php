<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function create(){
        return view("admin/posts.create");
    }

    public function index(){
        $user_id = session('user_id');
        $posts = Post::where('user_id',$user_id)->get();
        return view("admin/posts.index",[
        "posts"=> $posts
        ]);
    }

    public function store(){
        $attributes = request()->validate([
        'title' => 'required|max:255',
        'slug' => 'required|max:255',
        'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file type and size as needed
        'excerpt' => 'required',
        'body' => 'required',
        'category_id' => 'required|exists:categories,id', // Assuming categories table has an 'id' column
    ]);
    $attributes['user_id'] = session('user_id');
        $post = Post::create($attributes);
        return redirect('/admin/posts');
    }

    public function edit_post($post_id){
        $post = POST::where('id', $post_id)->first();
        return view('admin/posts.edit',['post'=>$post]);
    }

    public function update($post_id){
        $post = Post::where('id', $post_id)->update(request()->except(['_token','_method']));
        return redirect('/admin/posts/');

    }

    public function destroy($post_id){
        $post = Post::where('id', $post_id)->delete();
        return redirect('/admin/posts/');
    }

    public function view(){
        $user_id = session('user_id');
        $posts = POST::where('user_id', $user_id)->get();
        $categories = Category::all();
        return view('components.admin-home', ['posts' => $posts, 'categories' => $categories]);
    }
}
