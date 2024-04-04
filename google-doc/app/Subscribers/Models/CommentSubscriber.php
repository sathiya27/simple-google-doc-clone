<?php

namespace App\Subscribers\Models;

use Illuminate\Events\Dispatcher;
use App\Events\Models\Comment\CommentUpdate;
use App\Events\Models\Comment\CommentCreated;
use App\Events\Models\Comment\CommentDeleted;
use App\Listeners\Models\Comment\SendCommentCreated;
use App\Listeners\Models\Comment\SendCommentDeleted;
use App\Listeners\Models\Comment\SendCommentUpdated;


class CommentSubscriber
{
    public function subscribe(Dispatcher $events)
    {
        $events->listen(CommentCreated::class, SendCommentCreated::class);
        $events->listen(CommentUpdate::class, SendCommentUpdated::class);
        $events->listen(CommentDeleted::class, SendCommentDeleted::class);
    }
}