
<style>
.acta, .acta table{font-size: 13px;font-family:arial;}
p{
    padding:0;
    margin:5px 0 5px 0;
    text-align:justify;
}
.mayuscula{text-transform: uppercase;}
#instituto{text-decoration: underline;}
#alumnos, #alumnos th, #alumnos td {
    /*border: 1px solid black;*/
    font-size: 11px;
}
#cabecera, #cabecera th, #cabecera td {
    /*border: 1px solid black;*/
    font-size: 13px;
    
}
#tr_extra{line-height: 1.2em;}
</style>

<div class="acta">
    <table width="100%" id="cabecera">
        <tr>
            <td align="left"><img src="images/logo2.png" width="50" height="60"></td>
            <td align="left">
                <h2>CUPON DE PAGO</h2>
                <h3>Instituto de Estudios Superiores "SAN MARTIN DE PORRES"</h3>
            </td>
        </tr>
    </table>
    <br><br>
    @if($order->student)
        <table width="100%" id="cabecera" border=0>
            <tr>
                <td width="10"></td>
                <td width="30">
                    <h4>Apellido y Nombre</h4>
                    <h2>{{ $order->student->last_name }}, {{ $order->student->first_name }}</h2>
                </td>
                <td width="30">
                    <h4>DNI</h4>
                    <h2>{{ $order->student->dni }}</h2>
                </td>
                <td width="30">
                    <h4>Carrera</h4>
                    <h2>{{ $order->student->career->title }}</h2>
                </td>
            </tr>

            <tr>
                <td width="10"></td>
                <td width="30">
                    <h4>Fecha Vencimiento</h4>
                    <h2>{{ date('d/m/Y', strtotime($order->expirated_at)) }}</h2>
                </td>
                <td width="30">
                    <h4>Descripción</h4>
                    <h2>{{ $order->description }}</h2>
                </td>
                <td width="30">
                    <h4>Monto</h4>
                    <h2>${{ $order->amount }}</h2>
                </td>
            </tr>
        </table>
    @endif               
</div>
<br><br> 
<?php
$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
echo $generator->getBarcode($payment->barcode, $generator::TYPE_CODE_128);
?>
<h4>{{$payment->barcode}}</h4>