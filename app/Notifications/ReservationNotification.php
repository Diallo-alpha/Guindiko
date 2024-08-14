<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $reservation;

    /**
     * Créez une nouvelle instance de notification.
     *
     * @param  Reservation  $reservation
     * @return void
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Détermine les canaux de diffusion de la notification.
     *
     * @param  mixed  $notifiable
     * @return array<int, string>
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
        $menteeEmail = $this->reservation->mentee->email ?? 'inconnu'; // Utilisation de la relation user pour obtenir l'email
        $reservationId = $this->reservation->id;

        return (new MailMessage)
            ->subject('Nouvelle demande de réservation de session')
            ->line('Vous avez reçu une nouvelle demande de réservation de session de la part de ' . $menteeEmail)
            ->action('Voir la demande', url('/reservations/' . $reservationId))
            ->line('Merci de vérifier et de répondre à la demande.');
    }

    /**
     * Obtenez la représentation sous forme de tableau de la notification.
     *
     * @param  mixed  $notifiable
     * @return array<string, mixed>
     */
    public function toArray($notifiable): array
    {
        $menteeEmail = $this->reservation->user->email ?? 'inconnu'; // Utilisation de la relation user pour obtenir l'email
        $reservationId = $this->reservation->id;

        return [
            'mentee_email' => $menteeEmail,
            'reservation_id' => $reservationId,
            'message' => 'Vous avez reçu une nouvelle demande de reservation de la part de ' . $menteeEmail,
        ];
    }
}
