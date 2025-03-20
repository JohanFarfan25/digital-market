<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Las asignaciones de escucha de eventos para la aplicación.
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Registre cualquier evento para su aplicación.
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     * @return void
     */
    public function boot()
    {
        //
    }
}
