<?php

namespace App\Observers;

use App\Models\Student;

class StudentObserver
{
    /**
     * Handle the Student "created" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function created(Student $student)
    {
        //
    }

    /**
     * Handle the Student "updated" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function updated(Student $student)
    {
        if($student->status == "Inscripto"){

            $email = $student->user->email;

            $text = 'FELICITACIONES!!! Tu Inscripción ha sido aprobada!
                Te damos la bienvenida al ISMP.';
            $subtext = 'Pronto te llegarán a tu correo los datos de acceso al Campus para participar del Taller Propedéutico 
                que comenzará en Diciembre. Es obligatorio completarlo para que adquieras las competencias 
                necesarias para el cursado.';
            $body = '<style>
                .footer-copyright-area {
                    background: linear-gradient(178deg, #e12503 0%, #85060c 100%);
                    padding: 20px 0px 10px 0;
                    text-align: center;
                    color: #fff;
                    font-size: 12px;
                }
                .linea{
                    padding-top:0;
                    margin-top:0;
                    background: black;
                }
                .link{
                    color: #a52929;
                    text-decoration: underline;
                }
                .link:hover{
                    color: black;
                }
                </style>
                <!DOCTYPE html>
                <html>
                    <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                        <title>ISMP</title>
                        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
                    </head>
                    <body style="margin: 0; padding: 0;">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="500">
                            <tr style="padding-bottom:0">
                                <td align="left" bgcolor="#fff" style="border-left: 1px solid grey;border-right: 1px solid grey;">
                                    <img src="https://devweb.com.ar/ismp.academico/images/logo.jpg" width="150" style="margin-bottom:0"/>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#ffffff" style="padding: 10px 30px 20px 30px;border-left: 1px solid grey;border-right: 1px solid grey;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td>
                                                <p class="text-left">
                                                    <b>'.utf8_decode("Luego de realizar un análisis de la documentación presentada se observa lo siguiente:").'</b>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>   
                                            <td align="right" style="padding-left:40%;padding-top:0">
                                                <hr class="linea">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="text-left" style="padding:0 10% 0 10%" id="observaciones">'.utf8_decode($text).'</p>
                                                <br>
                                                <p class="text-left" style="padding:0 10% 0 10%" id="observaciones">'.utf8_decode($subtext).'</p>
                                            </td>
                                        </tr>
                                        <tr>   
                                            <td align="left" style="padding-right:40%;padding-top:0">
                                                <hr class="linea">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                <br><i>Gracias por elegir el ISMP<br>
                                                '.utf8_decode("Te deseamos éxitos en tu formación profesional.").'</i>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="background: linear-gradient(178deg, #e12503 0%, #85060c 100%); padding: 20px 0px 10px 0; text-align: center; color: #fff; font-size: 12px;">
                                        <p>Copyright &copy; '.date("Y").' <b>SinergySoft</b> Todos los derechos reservados.</p>
                                    </div>
                                </td>
                            </tr>
                        </table> 
                    </body>
                </html>';

            $asunto = "Inscripcion Exitosa ISMP";
            $headers = "MIME-Version: 1.0\r\n"; 
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
            $headers .= "From: ISMP Soporte <info@devweb.com.ar>\r\n"; 
    
            mail($email, $asunto, $body, $headers);    
        }
    }

    /**
     * Handle the Student "deleted" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function deleted(Student $student)
    {
        //
    }

    /**
     * Handle the Student "restored" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function restored(Student $student)
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function forceDeleted(Student $student)
    {
        //
    }
}
