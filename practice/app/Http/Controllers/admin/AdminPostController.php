<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminPostController extends Controller
{
    public function create()
    {
        return view('admin.posts.create');
    }

    public function index()
    {
        $user_id = request()->user()->id;
        /* $posts = cache()->remember('admin_posts', 600, function ($user_id) {
            return Post::where('user_id',$user_id)->get();
        }); */
        $posts = Post::where('user_id', $user_id)->get();

        return view('admin.posts.index', [
            'posts' => $posts,
        ]);
    }

    public function store(AdminPostRequest $request)
    {
        $post = auth()->user()->posts()->create($request->validated());

        // $postData = $request->validated();
        // $postData['user_id'] = Auth::user()->user_id;
        // $post = Post::create($postData);
        // return response()->json(['message' => "Post Created Successfully"]);    // For Back-End
        return redirect('api/admin/posts');
    }

    public function edit_post($post_id)
    {
        $post = POST::where('id', $post_id)->first();

        return view('admin/posts.edit', ['post' => $post]);
    }

    public function update($post_id)
    {
        $post = POST::where('id', $post_id)->first();
        $response = Gate::inspect('update', $post);
        if ($response->allowed()) {
            $post = Post::where('id', $post_id)->update(request()->except(['_token', '_method']));

            //return response()->json(['message' => "Post Updated Successfully"]);    // For Back-End
            return redirect('api/admin/posts/');
        } else {
            return response()->json(['message' => $response->message()]);
        }
    }

    public function destroy($post_id)
    {
        $post = POST::where('id', $post_id)->first();
        $response = Gate::inspect('delete', $post);
        if ($response->allowed()) {
            $post = Post::where('id', $post_id)->delete();

            // return response()->json(['message' => "Post Deleted Successfully"]);    // For Back-End
            return redirect('api/admin/posts/');
        } else {
            return response()->json(['message' => $response->message()]);
        }
    }

    public function view()
    {
        $category_id = request('category_id');
        $latest = request('latest');
        $user_id = auth()->user()->user_id;

        if (! empty($category_id)) {
            if ($latest == true) {
                $posts = POST::where('user_id', $user_id)->where('category_id', $category_id)
                    ->orderBy('published_at', 'desc')->get();
            } else {
                $posts = POST::where('user_id', $user_id)
                    ->where('category_id', $category_id)->get();
            }
        } elseif (! empty($latest)) {
            $posts = POST::where('user_id', $user_id)->orderBy('published_at', 'desc')->get();
        } else {
            $posts = POST::where('user_id', $user_id)->get();
        }

        /* $posts = cache()->remember('admin_home_posts', 600, function ($user_id) {
        }); */
        // return response()->json(['posts' => $posts,]);              // For back_end
        return view('components.filtered-posts', ['posts' => $posts]);
    }
}
