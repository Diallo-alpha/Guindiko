<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\SessionMentorat;

class SessionMentoratCreee extends Notification
{
    use Queueable;

    protected $sessionMentorat;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\SessionMentorat  $sessionMentorat
     * @return void
     */
    public function __construct(SessionMentorat $sessionMentorat)
    {
        $this->sessionMentorat = $sessionMentorat;
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
                    ->line('Une nouvelle session de mentorat a été créée.')
                    ->line('Formation : ' . $this->sessionMentorat->formationUser->formation->nom)
                    ->line('Date : ' . $this->sessionMentorat->date)
                    ->line('Durée : ' . $this->sessionMentorat->duree)
                    ->action('Voir la session', url('/sessions/' . $this->sessionMentorat->id))
                    ->line('Merci de votre attention.');
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
            'session_id' => $this->sessionMentorat->id,
            'formation' => $this->sessionMentorat->formationUser->formation->nom,
            'date' => $this->sessionMentorat->date,
            'duree' => $this->sessionMentorat->duree,
        ];
    }
}
