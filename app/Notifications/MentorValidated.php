<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class MentorValidated extends Notification
{
    use Queueable;

    protected $password;

    /**
     * Créez une nouvelle instance de notification.
     *
     * @param  string  $password
     * @return void
     */
    public function __construct(string $password)
    {
        $this->password = $password;
    }

    /**
     * Détermine les canaux de diffusion de la notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Obtenez la représentation par e-mail de la notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Validation de votre statut de Mentor')
                    ->line('Félicitations ! Vous avez été validé en tant que mentor.')
                    ->line('Vous pouvez maintenant vous connecter à la plateforme avec le mot de passe suivant :')
                    ->line('Mot de passe : ' . $this->password)
                    ->line('Veuillez vous connecter pour accéder aux fonctionnalités réservées aux mentors.')
                    ->line('Merci pour votre patience.');
    }

    /**
     * Obtenez la représentation sous forme de tableau de la notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            'message' => 'Votre statut de mentor a été validé.',
            'password' => $this->password,
        ];
    }
}
