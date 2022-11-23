<?php

namespace Core\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable,SerializesModels;

    public function __construct()
    {
    }

    public function build()
    {
        return $this->view('core::admin.emails.test');
    }
}
