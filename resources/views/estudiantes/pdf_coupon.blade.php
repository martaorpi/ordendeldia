
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
    <div align="center">
        <h2>CUPON DE PAGO</h2>
    </div>
    @if($order->student)
        <table width="100%" id="cabecera" border=0>
            <tr>
                <td width="10"></td>
                <td width="30">
                    <h5>Apellido y Nombre</h5>
                    <h3>{{ $order->student->last_name }}, {{ $order->student->first_name }}</h3>
                </td>
                <td width="30">
                    <h5>DNI</h5>
                    <h3>{{ $order->student->dni }}</h3>
                </td>
                <td width="30">
                    <h5>Carrera</h5>
                    <h3>{{ $order->student->career->title }}</h3>
                </td>
            </tr>

            <tr>
                <td width="10"></td>
                <td width="30">
                    <h5>Fecha Vencimiento</h5>
                    <h3>{{ date('d/m/Y', strtotime($order->expirated_at)) }}</h3>
                </td>
                <td width="30">
                    <h5>Descripción</h5>
                    <h3>{{ $order->description }}</h3>
                </td>
                <td width="30">
                    <h5>Monto</h5>
                    <h3>${{ $order->amount }}</h3>
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