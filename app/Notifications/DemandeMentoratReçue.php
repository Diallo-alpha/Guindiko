<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\DemandeMentorat;

class DemandeMentoratReçue extends Notification
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
        return ['mail', 'database']; // This sends the notification via email and stores it in the database
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
                    ->subject('Nouvelle demande de mentorat')
                    ->line('Vous avez reçu une nouvelle demande de mentorat de la part de ' . $this->demandeMentorat->mentee->email)
                    ->action('Voir la demande', url('/demandes/' . $this->demandeMentorat->id))
                    ->line('Merci de vérifier et de répondre à la demande.');
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
            'mentee_email' => $this->demandeMentorat->mentee->email,
            'demande_id' => $this->demandeMentorat->id,
            'message' => 'Vous avez reçu une nouvelle demande de mentorat de la part de ' . $this->demandeMentorat->mentee->email,
        ];
    }
}
