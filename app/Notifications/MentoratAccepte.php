<?php

namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\DemandeMentorat;

class MentoratAccepte extends Notification
{
    use Queueable;

    public $demandeMentorat;

    /**
     * Create a new notification instance.
     *
     * @param  DemandeMentorat  $demandeMentorat
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
            ->subject('Votre demande de mentorat a été acceptée !')
            ->greeting('Félicitations !')
            ->line('Bonjour ' . $this->demandeMentorat->mentee->name . ',')
            ->line('Votre demande de mentorat a été acceptée par ' . $this->demandeMentorat->mentor->name . '.')
            ->line('Vous pouvez maintenant participer aux sessions créées par votre mentor.')
            ->line('Pour plus d\'informations, veuillez consulter votre tableau de bord.')
            ->salutation('Bien cordialement,')
            ->line('L\'équipe de ' . config('app.name'));
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
            'demande_mentorat_id' => $this->demandeMentorat->id,
            'mentor_id' => $this->demandeMentorat->mentor->id,
            'mentee_id' => $this->demandeMentorat->mentee->id,
        ];
    }
}
