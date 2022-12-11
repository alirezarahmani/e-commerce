<?php

namespace App\Providers;

use App\Events\OrderCanceled;
use App\Events\OrderDone;
use App\Listeners\OrderCanceledListener;
use App\Listeners\OrderCreatedListener;
use App\Listeners\OrderDoneListener;
use App\Listeners\ProductAddedToBasketListener;
use App\Listeners\ProductRemovedFromBasketListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        OrderDone::class => [
            OrderDoneListener::class,
        ],
        OrderCanceled::class => [
            OrderCanceledListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(
            OrderCanceledListener::class,
            [OrderCanceled::class, 'handle']
        );
        Event::listen(
            OrderDoneListener::class,
            [OrderDone::class, 'handle']
        );
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
