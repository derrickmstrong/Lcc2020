<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\User;
use App\Models\Post;

class PostLiked extends Mailable
{
    use Queueable, SerializesModels;

    // Global properties available to all methods below
    public $userWhoLiked;
    public $post;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $userWhoLiked, Post $post)
    {
        $this->userWhoLiked = $userWhoLiked;
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.posts.post_liked')->subject('Someone liked your post!');
    }
}
