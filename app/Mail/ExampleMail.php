<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExampleMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
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
        return $this->from('davidkouachi02@gmail.com', 'COHERENCE')
                ->subject('Sujet de l\'e-mail')
                ->view('add.processus') // Vue pour le contenu de l'e-mail
                ->with([
                    'title' => $this->details['title'],
                    'body' => $this->details['body'],
                ]);
    }
}
