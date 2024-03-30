<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Publicacion;

class PostNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @param  Publicacion  $publicacion
     * @return void
     */
    public function __construct(Publicacion $publicacion)
    {
        $this->publicacion = $publicacion;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'notifiable_id' => $notifiable->getKey(), // Obtén el ID del notifiable
            'notifiable_type' => get_class($notifiable),
            'image' => $this->publicacion->administrador['imagen'],
            'name' => "{$this->publicacion->administrador['name']} {$this->publicacion->administrador['apellido_pat']} {$this->publicacion->administrador['apellido_mat']}",
            'text' => "ha realizado una publicación.",
            'route' => "apps.comunidad_estudiante.index",
        ];
    }
}
