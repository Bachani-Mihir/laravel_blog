<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Comments;

class PostController extends Controller
{
    public $categories;
    public function __construct()
    {
        $this->categories = Category::all();
    }
    public function view(){
        $posts = Post::all();
        /* if(request('search')){
            //dd(request('search'));
            $posts->where('title', 'like', '%'.request('search').'%');
        } */
        return view('components.posts', ['posts' => $posts, 'categories' => $this->categories]);
    }
    public function show_post($slug) {
        $post = Post::where('slug', $slug)->first();
        return view('components.show-post', [
        'post' => $post,'categories' => $this->categories
        ]);
    }
    public function show_post_by_category($category_id){
       // dd(request());
       $posts = Post::where('category_id', $category_id)->get();
       return view('components.posts-by-category', [
            'posts' => $posts,'categories' => $this->categories,'current_category' => $category_id
        ]);
    }
    public function filter_posts_by_author($author_id){
        $posts = Post::where('user_id', $author_id)->get();
        return view('components.posts-by-author', [
            'posts' => $posts,'categories' => $this->categories
        ]);
    }
    public function show_post_by_author_category($author_id,$category_id){
        $user = User::where('user_id', $author_id)->first();;
        $user_id = $user->user_id;
        $posts = Post::where([
            'user_id' => $user_id,
            'category_id' => $category_id,
        ])->get();
        return view('components.posts-by-category', [
            'posts' => $posts,'categories' => $this->categories,'current_category' => $category_id
        ]);
    }
}
