<?php

namespace App\Mail;

use App\registration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CampRegistration extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(registration $registration, $link)
    {
        $this->registration = $registration;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Emails/registeredemail');
    }
}
