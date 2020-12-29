<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Like;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body'
    ];

    // Check if given user has already liked post
    public function likedBy(User $user) {
        return $this->likes->contains('user_id', $user->id);  // Constains is a Laravel Collection method - checks wheter the user)id is in the list of likes
    }

    // Check if a post is owned by logged in user user to verify a user can delete a particular post
    // public function ownedBy(User $user)
    // {
    //     return $user->id === $this->user_id;
    // }

    // Create user relationship between post and user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Create likes relationship between likes and post and users
    public function likes() {
        return $this->hasMany(Like::class);
    }
}
