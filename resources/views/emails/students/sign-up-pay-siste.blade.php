<style>
    .footer-copyright-area {
        background: linear-gradient(178deg, #e12503 0%, #85060c 100%);
        padding: 20px 0px 10px 0;
        text-align: center;
        color: #fff;
        font-size: 12px;
    }
    .linea{
        border: 1px solid black;
        padding-top:0;
        margin-top:0;
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
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    
            <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.9/css/mdb.min.css" rel="stylesheet">
            <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.9/js/mdb.min.js"></script>-->
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
                                        <b>FELICITACIONES!!! Tu documentación ha sido aprobada!<br>
                                        Te damos la bienvenida al Sistema de Inscripciones</b>
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
                                    <p class="text-left" style="padding:0 10% 0 10%">
                                        Ahora estás habilitado para realizar el pago de la matrícula de la carrera que elegiste, para finalizar el proceso de inscripción
                                    </p>
                                </td>
                            </tr>
                            <tr>   
                                <td align="left" style="padding-right:40%;padding-top:0">
                                    <hr class="linea">
                                </td>
                            </tr>
                            {{--<tr>
                                <td>
                                    <b style="color:#a52929"> <a href="http://190.105.227.212/consultas/Account/Login" class="link">SISTEMA DE PAGO</a><br>
                                    Tu usuario es <b>{{$user_dni}}</b> y tu clave es <b>{{$pass_dni}}</b><br>
                                    Imprimí el cupón y pagalo en Sol Pago o Banco Santiago</b>
                                </td>
                            </tr>--}}
                            <tr>
                                <td align="center">
                                    <br><i>Gracias por elegir el ISMP<br>
                                    Te deseamos éxitos en tu formación profesional.</i>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="background: linear-gradient(178deg, #e12503 0%, #85060c 100%); padding: 20px 0px 10px 0; text-align: center; color: #fff; font-size: 12px;">
                            <p>Copyright &copy; {{date("Y")}} <b>Relaciones Publicas Policiales</b> Todos los derechos reservados.</p>
                        </div>
                    </td>
                </tr>
            </table> 
        </body>
    </html>