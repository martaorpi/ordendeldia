<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentsMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subjet = "informacion de contacto";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /*return $this->view('emails.prueba')
        ->with([
            'orderName' => "dddddddddd",
        ]);*/
    }

    public function mailEnrolled()
    {
        return $this->view('emails.students.enrolled')->subject("Tu Inscripción ha sido aprobada");
    }

    public function mailFormCompleted()
    {
        return $this->view('emails.students.form-completed')->subject("Tu Formulario fue completado");
    }

    public function mailSignUpPaySistem($dni)
    {
        $arr1 = str_split($dni);
        $pass_dni = $arr1[2].$arr1[3].$arr1[4].$arr1[5].$arr1[6].$arr1[7];

        return $this->view('emails.students.sign-up-pay-siste')->subject("Alta sistema de cobranza")->with([
            'user_dni' => $dni,
            'pass_dni' => $pass_dni,
        ]);
    }
}
