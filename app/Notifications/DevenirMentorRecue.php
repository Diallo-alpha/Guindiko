<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\DevnirMentor;

class DevenirMentorRecue extends Notification
{
    use Queueable;

    protected $demande;

    /**
     * Create a new notification instance.
     */
    public function __construct(DevnirMentor $demande)
    {
        $this->demande = $demande;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                        ->line('Une nouvelle demande pour devenir mentor a été reçue.')
                        ->action('Voir la demande', url('/admin/mentor/demandes'))
                        ->line('Merci d\'examiner cette demande.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'demande_id' => $this->demande->id,
            'parcours_academique' => $this->demande->parcours_academique,
            'diplome' => $this->demande->diplome,
            'langue' => $this->demande->langue,
            'cv' => $this->demande->cv,
            'experience' => $this->demande->experience,
            'domaine' => $this->demande->domaine,
            'message' => 'Une nouvelle demande pour devenir mentor a été reçue.',
        ];
    }
}
