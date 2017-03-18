<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $input;

    public function __construct($input)
    {
        $this->input = $input;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM'), env('MAIL_NAME'))
            ->replyTo($this->input['email'], $this->input['name'])
            ->subject('Iemand heeft contact gezocht via Larabene.com')
            ->view('emails.forms.contact');
    }
}
