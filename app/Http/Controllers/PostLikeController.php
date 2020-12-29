<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

use App\Mail\PostLiked;
use Illuminate\Support\Facades\Mail;

class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']); // User must be authenticated (logged in) in order to like a post
    }

    public function store(Post $post, Request $request)
    {
        // dd('store'); Testing Only
        // dd($post);
        // dd($post->id);
        // dd($post->likedBy($request->user()));
        // dd($post->likes()->withTrashed()->get()); // same as onlyTrashed()

        if ($post->likedBy($request->user())) {
            return response(null, 409);
        }

        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        // Send an email to user that their post was liked
        // $user = auth()->user(); // Person who is liking post
        //The two parameters are the authenticated user and the post that has been liked

        // Only send email if there are no previous likes from this (logged in) user
        if (!$post->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count())
        {
            Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
        }

        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        // dd($post); Testing

        // We want to $request user likes where post_id equals $post->id and delete it
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}
