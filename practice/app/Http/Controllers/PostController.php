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
    public function __construct(){
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

    public function filter_posts(){

        $author_id = request('author_id');
        $category_id = request('category_id');
        $latest = request('latest');            // Stores Boolean Value (True/False)
        $search = request('search');

        if(!empty($search)){
            $posts = Post::where('body', 'like', '%' . $search . '%')->get();
            @dd($posts);
            return view('components.filtered-posts', ['posts' => $posts, 'categories' => $this->categories]);
        }

        if (!empty($author_id) && !empty($category_id)) {
            if($latest == true){
                $posts = Post::where('user_id',$author_id)->where('category_id',$category_id)
                ->orderBy('published_at', 'desc')->get();
            }else{
                $posts = Post::where('user_id',$author_id)->where('category_id',$category_id)->get();
            }
            return view('components.filtered-posts', ['posts' => $posts, 'categories' => $this->categories]);
        }
        else if (!empty($category_id)) {
            if($latest == true) {
                $posts = Post::where('category_id', $category_id)->orderBy('published_at', 'desc')->get();
            }else{
                $posts = Post::where('user_id',$author_id)->where('category_id',$category_id)->get();
            }
            return view('components.filtered-posts', ['posts' => $posts, 'categories' => $this->categories]);
        }
        else if (!empty($author_id)) {
            if($latest == true) {
                $posts = Post::where('user_id', $author_id->orderBy('published_at', 'desc'))->get();
            }else{
                $posts = Post::where('user_id', $author_id)->get();
            }
            return view('components.filtered-posts', ['posts' => $posts, 'categories' => $this->categories]);
        }
        else{
            $posts = Post::all();
            return view('components.posts', ['posts' => $posts, 'categories' => $this->categories]);
        }
    }

    public function show_post($slug) {
        $post = Post::where('slug', $slug)->first();
        return view('components.show-post', [
        'post' => $post,'categories' => $this->categories
        ]);
    }

}
