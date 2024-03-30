<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Cita;
use Carbon\Carbon;

class CitaEstudianteNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @param  Cita  $cita
     * @return void
     */
    public function __construct(Cita $cita)
    {
        $this->cita = $cita;
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
            'image' => $this->cita->administrador['imagen'],
            'name' => "{$this->cita->administrador['name']} {$this->cita->administrador['apellido_pat']} {$this->cita->administrador['apellido_mat']}",
            'text' => "ha agendado una cita contigo.",
            'route' => "apps.cita_estudiante.index",
        ];
    }
}
