<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @param array $details
     */
    public function __construct(array $details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reservation Confirmation')
        ->from(config('mail.from.address'), config('mail.from.name'))
        ->to($this->details['email'])
        ->text('reservation_plain') // Use a plain text email
        ->with([
            'name' => $this->details['name'],
            'date' => $this->details['date'],
            'mentor' => $this->details['mentor'],
        ]);

    }
}
