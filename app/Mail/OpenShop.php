<?php

namespace App\Mail;

use App\Models\VenderShop;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OpenShop extends Mailable
{
    use Queueable, SerializesModels;

    public VenderShop $newShop;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($newShop)
    {
        //
        $this->newShop = $newShop;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New shop Activation')->view('mails.shop-mail');
    }
}
