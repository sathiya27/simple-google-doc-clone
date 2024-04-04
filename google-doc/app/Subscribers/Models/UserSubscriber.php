<?php

namespace App\Subscribers\Models;

use App\Events\Models\User\UserCreated;
use App\Events\Models\User\UserDeleted;
use App\Events\Models\User\UserUpdated;
use Illuminate\Contracts\Events\Dispatcher;
use App\Listeners\Models\User\SendGoodbyeEmail;
use App\Listeners\Models\User\SendWelcomeEmail;
use App\Listeners\Models\User\SendUserUpdateEmail;

class UserSubscriber {

    public function subscribe(Dispatcher $events)
    {
        $events->listen(UserCreated::class, SendWelcomeEmail::class);
        $events->listen(UserDeleted::class, SendGoodbyeEmail::class);
        $events->listen(UserUpdated::class, SendUserUpdateEmail::class);
    }
}