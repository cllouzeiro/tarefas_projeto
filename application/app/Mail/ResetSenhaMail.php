<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetSenhaMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $dados;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $senha)
    {
        $this->dados['user'] = $user;
        $this->dados['nova_senha'] = $senha;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('emailteste@email.com')
                    ->view('emails.reset_senha', $this->dados);
    }
}
