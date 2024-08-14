<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\DemandeMentorat;

class MentoratRefuse extends Notification
{
    use Queueable;

    protected $demandeMentorat;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\DemandeMentorat  $demandeMentorat
     * @return void
     */
    public function __construct(DemandeMentorat $demandeMentorat)
    {
        $this->demandeMentorat = $demandeMentorat;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Votre demande de mentorat a été refusée.')
                    ->line('Mentor: ' . $this->demandeMentorat->mentor->name)
                    ->line('Formation: ' . $this->demandeMentorat->formation)
                    ->line('Merci de votre compréhension.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'demande_id' => $this->demandeMentorat->id,
            'statut' => 'refusée',
            'mentor' => $this->demandeMentorat->mentor->name,
            'formation' => $this->demandeMentorat->formation,
        ];
    }
}
