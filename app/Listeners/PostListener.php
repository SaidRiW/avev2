<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\PostNotification;
use App\Models\User;
use App\Models\Estudiante;
class PostListener
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
        $grupoId = $event->publicacion->grupo["id_grupo"];
        $estudiantes = Estudiante::where('grupo.id_grupo', '=', $grupoId)->get();
    
        foreach ($estudiantes as $estudiante) {
            $usuario = User::where('_id', $estudiante->id_user)->first();
            if ($usuario) {
                $usuario->notify(new PostNotification($event->publicacion));
            }
        }
    }    
}
