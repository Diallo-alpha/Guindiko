<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DemandeMentoratMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mentee;
    public $mentor;

    public function __construct($mentee, $mentor)
    {
        $this->mentee = $mentee;
        $this->mentor = $mentor;
    }

    public function build()
    {
        if ($this->mentee) {
            return $this->view('demande_mentorat')
                        ->with([
                            'mentee' => $this->mentee,
                        ]);
        } else {
            // Vous pouvez gérer le cas où l'un des objets est nul ici
            // Par exemple, renvoyer une erreur ou un message par défaut
            return $this->view('error_mentorat');
        }
    }
    
}
