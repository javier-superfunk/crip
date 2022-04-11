<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BienvenidaUsuario extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $usuario;
    protected $clave;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $usuario, String $clave)
    {
        //
        $this->usuario = $usuario;
        $this->clave = $clave;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Te damos la bienvenida, '.$this->usuario->name.'!')
                    ->markdown('emails.usuarios.bienvenida', [
                                    'usuario'  => $this->usuario,
                                    'password' => $this->clave,
                                ]);
    }
}
