<?php

namespace App\Listeners\Models\Comment;

use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\Models\Comment\CommentCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCommentCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Mail::to($event->comment->user)
        ->send(new CommentCreatedMail($event->comment));
    }
}
