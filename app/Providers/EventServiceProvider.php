<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\CitaAdminEvent;
use App\Listeners\CitaAdminListener;
use App\Events\CitaEstudianteEvent;
use App\Listeners\CitaEstudianteListener;
use App\Events\CitaEditEstudianteEvent;
use App\Listeners\CitaEditEstudianteListener;
use App\Events\CitaCancelEstudianteEvent;
use App\Listeners\CitaCancelEstudianteListener;
use App\Events\PostEvent;
use App\Listeners\PostListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CitaAdminEvent::class => [
            CitaAdminListener::class,
        ],
        CitaEstudianteEvent::class => [
            CitaEstudianteListener::class,
        ],
        CitaEditEstudianteEvent::class => [
            CitaEditEstudianteListener::class,
        ],
        CitaCancelEstudianteEvent::class => [
            CitaCancelEstudianteListener::class,
        ],
        PostEvent::class => [
            PostListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
