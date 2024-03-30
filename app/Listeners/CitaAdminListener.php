<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\CitaAdminNotification;
use App\Models\User;

class CitaAdminListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $usuario = User::where('_id', $event->cita->administrador["id_admin"])->first();
        $usuario->notify(new CitaAdminNotification($event->cita));
    }
}
