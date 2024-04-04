<?php

namespace App\Subscribers\Models;

use App\Events\Models\Post\PostUpdate;
use App\Events\Models\Post\PostCreated;
use App\Events\Models\Post\PostDeleted;
use Illuminate\Contracts\Events\Dispatcher;
use App\Listeners\Models\Post\SendPostDeleted;
use App\Listeners\Models\Post\SendPostUpdated;
use App\Listeners\Models\Post\SendPostCreatedEmail;

class PostSubscriber 
{
    public function subscribe(Dispatcher $events)
    {
        $events->listen(PostCreated::class, SendPostCreatedEmail::class);
        $events->listen(PostUpdate::class, SendPostUpdated::class);
        $events->listen(PostDeleted::class, SendPostDeleted::class);
    }
}