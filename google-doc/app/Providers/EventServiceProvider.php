<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Subscribers\Models\PostSubscriber;
use App\Subscribers\Models\UserSubscriber;
use App\Subscribers\Models\CommentSubscriber;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        /* UserCreated::class =>[
            SendWelcomeEmail::class,
        ],

        UserDeleted::class=>[
            SendGoodbyeEmail::class,
        ] 
        
        UserUpdated::class=>[
            SendUserUpdateEmail::class,
        ]

        PostCreated::class=>[
            SendPostCreatedEmail::class,
        ]

        CommentCreated::class=>[
            SendCommentCreated::class,
        ]

        CommentDeleted::class=>[
            SendCOmmentDeleted::class,
        ]
        */
    ];

    protected $subscribe = [
        UserSubscriber::class,
        PostSubscriber::class,
        CommentSubscriber::class,
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
