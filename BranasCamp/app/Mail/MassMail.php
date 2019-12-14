<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MassMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail)
    {
        $this->mail = $mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->mail->attachment == null){
            return $this->view('Emails/defaultmail')
                        ->subject($this->mail->subject);
        } else {
            return $this->view('Emails/defaultmail')
                        ->subject($this->mail->subject)
                        ->attach(\storage_path('app/mailAttachments/'.$this->mail->attachment), [
                            'as' => $this->mail->attachment_send_name,
                            'mime' => 'application/pdf',
                        ]);
        }
    }
}
