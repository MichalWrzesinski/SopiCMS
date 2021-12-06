<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(Array $data)
    {
        $this->data = $data;
        $this->data['body'] = str_replace("\n", '<br>', $this->data['body']);
    }

    public function build()
    {
        return $this->from(config('sopicms.email'), config('sopicms.siteName'))
            ->subject($this->data['subject'])
            ->markdown('tools.mail')
            ->with($this->data);
    }
}
