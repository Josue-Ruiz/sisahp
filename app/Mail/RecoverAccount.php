<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecoverAccount extends Mailable
{
    use Queueable, SerializesModels;

    public $datos;

    public function __construct($datos)
    {
        $this->datos = $datos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      
        return $this->subject('Recuperar Cuenta')
            ->view('components.autentication.mail_recuperar',['usuario'=>$this->datos['nombre'],'token'=>$this->datos['token'],'correo'=>$this->datos['correo']]);
              
    }
}
