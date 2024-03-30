<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\CitaEditEstudianteNotification;
use App\Models\User;

class CitaEditEstudianteListener
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
        $usuario = User::where('_id', $event->cita->estudiante["id_user"])->first();
        $usuario->notify(new CitaEditEstudianteNotification($event->cita));
    }
}
