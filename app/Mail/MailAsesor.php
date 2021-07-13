<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailAsesor extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $users;
    public $tipo;
    public $asesor;
    public function __construct($users, $tipo, $asesor)
    {
        $this->users = $users;
        $this->tipo = $tipo;
        $this->asesor = $asesor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        switch ($this->tipo) {
            case 1:
                return $this->view('mail.asesor_venta'); //Correo para el asesor con venta
                break;
            case 2:
                return $this->view('mail.usuario_venta'); //Correo para el usuario con venta
                break;
            case 3:
                return $this->view('mail.asesor_error'); //Correo para el asesor sin poliza
                break;
            case 4:
                return $this->view('mail.usuario_error'); //Correo para el usuario sin poliza
                break;
        }

    }
}
