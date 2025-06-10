<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

      public $data;


       public function __construct($data)
    {
        $this->data = $data;
    }


    public function build()
    {
          if (isset($this->data['reply_message'])) {
            return $this->subject('Reply to Your Inquiry')
                ->html('<p>Dear ' . $this->data['name'] . ',</p> <p>' . nl2br(e($this->data['reply_message'])) . '</p>');
        }
        if(isset($this->data['message'])) {
            return $this->subject($this->data['subject'])
                ->html('<p>' . nl2br(e($this->data['message'])) . '</p>');
        }
        $email = $this->subject('New Contact Inquiry')
            ->view('admin.inquiry.email_template') 
            ->with('data', $this->data);

        if (!empty($this->data['file_path'])) {
            $email->attach($this->data['file_path']);
        }

        return $email;
    }
//   mail reply

  
    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Contact Mail',
    //     );
    // }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
