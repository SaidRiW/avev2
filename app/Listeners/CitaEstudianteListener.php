<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\CitaEstudianteNotification;
use App\Models\User;

class CitaEstudianteListener
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
        $usuario->notify(new CitaEstudianteNotification($event->cita));
    }
}
