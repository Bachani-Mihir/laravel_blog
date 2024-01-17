<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function view()
    {
        $posts = Post::all();

        /* $posts = cache()->remember('home_posts', 600, function () {
            return Post::all();
        }); */
        // return response()->json([$posts]);  // for back-end
        return view('components.posts', ['posts' => $posts]);
    }

    public function filter_posts()
    {
        $author_id = request('author_id');
        $category_id = request('category_id');
        $latest = request('latest');            // Stores Boolean Value (True/False)
        $search = request('search');
        if (! empty($search)) {
            $posts = Post::where('slug', 'like', '%'.$search.'%')->
                orWhere('title', 'like', '%'.$search.'%')->
                orWhere('body', 'like', '%'.$search.'%')->
                orWhere('excerpt', 'like', '%'.$search.'%')->get();

            // return $posts;      // for back-end side development
            return view('components.filtered-posts', ['posts' => $posts]);
        } elseif (! empty($author_id) && ! empty($category_id)) {
            if ($latest == true) {
                $posts = Post::where('user_id', $author_id)->where('category_id', $category_id)
                    ->orderBy('published_at', 'desc')->get();
            } else {
                $posts = Post::where('user_id', $author_id)->where('category_id', $category_id)->get();
            }

            // return $posts;      // for back-end side development
            return view('components.filtered-posts', ['posts' => $posts]);
        } elseif (! empty($category_id)) {
            if ($latest == true) {
                $posts = Post::where('category_id', $category_id)->orderBy('published_at', 'desc')->get();
            } else {
                $posts = Post::where('category_id', $category_id)->get();
            }

            // return $posts;      // for back-end side development
            return view('components.filtered-posts', ['posts' => $posts]);
        } elseif (! empty($author_id)) {
            if ($latest == true) {
                $posts = Post::where('user_id', $author_id->orderBy('published_at', 'desc'))->get();
            } else {
                $posts = Post::where('user_id', $author_id)->get();
            }

            // return $posts;      // for back-end side development
            return view('components.filtered-posts', ['posts' => $posts]);
        } else {
            $posts = Post::all();

            // return $posts;      // for back-end side development
            return view('components.posts', ['posts' => $posts]);
        }
    }

    public function show_post($slug)
    {
        $post = Post::where('slug', $slug)->first();

        // return $post;   // for back-end
        return view('components.show-post', ['post' => $post]);
    }
}
