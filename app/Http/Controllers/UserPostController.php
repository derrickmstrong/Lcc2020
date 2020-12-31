<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserPostController extends Controller
{
    public function index(User $user)
    {
        // dd($user->posts);

        $posts = $user->posts()->with(['user', 'likes'])->paginate(3);

        return view('users.posts.index', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
