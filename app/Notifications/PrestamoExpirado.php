<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class PrestamoExpirado extends Notification implements ShouldQueue
{
    use Queueable;

    protected $prestamo;
    /**
     * Create a new notification instance.
     */
    public function __construct($prestamo)
    {
        //
        $this->prestamo = $prestamo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
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
            //
            'prestamo_id' => $this->prestamo->id,
            'fecha_devolucion' => $this->prestamo->fecha_devolucion,
            'mensaje' => 'El prestamo está por expirar.',
        ];
    }
}
