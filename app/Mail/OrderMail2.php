<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class OrderMail2 extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    
    // Adataid tárolására szolgáló publikus változó
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Levél tartalmának összeállítása
        return $this->from('support@plaza.hu')
                    ->view('frontend.mail.order_mail_2')
                    ->with('order', $this->data)
                    ->subject('Online Rendelés');
    }
} 
