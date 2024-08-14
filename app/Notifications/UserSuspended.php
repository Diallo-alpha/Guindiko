<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class UserSuspended extends Notification
{
    use Queueable;

    protected $reason;

    /**
     * Créez une nouvelle instance de notification.
     *
     * @return void
     */
    public function __construct($reason)
    {
        $this->reason = $reason;
    }

    /**
     * Obtenez les canaux de diffusion de la notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Obtenez la représentation par e-mail de la notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Avis de Suspension de Compte')
                    ->line('Votre compte a été suspendu.')
                    ->line('Raison : ' . $this->reason)
                    ->line('Veuillez contacter le support pour plus d\'assistance.');
    }

    /**
     * Obtenez la représentation sous forme de tableau de la notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'Votre compte a été suspendu.',
            'reason' => $this->reason,
        ];
    }
}

