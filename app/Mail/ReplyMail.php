<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageData;

    public function __construct(Message $message, $informationContact)
    {
        $this->messageData = $message;
        $this->informationContact = $informationContact;
    }

    public function build()
    {
        return $this->subject('Balasan dari Admin')
            ->view('emails.reply')
            ->with('messageData', $this->messageData);
    }
}
