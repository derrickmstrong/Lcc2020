<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    public function index()
    {
        // $posts = Post::get(); // Collections that returns all post

        // Pagination with Eagle Loading and OrderBy
        $posts = Post::orderBy('created_at', 'desc')->with(['user', 'likes'])->paginate(10); // Display only 10 per page

        return view('posts.index', [
            "posts" => $posts
        ]);
    }

    public function show(Post $post)
    {
        // Return Individual post
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function store(Request $request)
    {
        // dd('ok'); // Testing-Only

        // validate
        $this->validate($request, [
            'body' => 'required',
        ]);

        // Create new post
        $request->user()->posts()->create([
            'body' => $request->body,
        ]);

        // Redirect
        return redirect()->route('posts');
    }

    public function destroy(Post $post)
    {
        // dd($post);  Testing 

        // if (!$post->ownedBy(auth()->user()))
        // {
        //     dd('You don\'t own this post!');
        // }

        $this->authorize('delete', $post);

        $post->delete();

        return  back();
    }
}
