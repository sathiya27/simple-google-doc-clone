<?php

namespace App\Mail\Models\Comment;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    private $comment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject("Comment created")
        ->markdown('Mail.Models.Comment.CommentCreated-mail', [
            'post_name'=>$this->comment->post->title,
            'username'=>$this->comment->user->name,
        ]);
    }
}
