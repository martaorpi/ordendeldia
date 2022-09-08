<style>
    td{padding:20px;}
</style>

@php
    $param = explode('&',$param);
    $valor_indice_2022 = 149.68;
    $cargo = $param[0];
    $antig = $param[1];
    $titulo = $param[2];
    $transporte = $param[3];
    $cargo_publico = $param[6];

    if($cargo == 15.1){
        $horas_sup = $param[4];
        $horas_sec = $param[5];
        $basico = $horas_sup * $valor_indice_2022;
        $transporte = $transporte * $horas_sup * $valor_indice_2022;
    }else{
        $horas_sup = 0;
        $horas_sec = 0;
        $basico = $cargo * $valor_indice_2022;
        $transporte = $transporte;
    }
    $antig = $basico * $antig;
    $titulo = $valor_indice_2022 * $titulo;
    $bruto = $basico + $antig + $titulo;
    $desc_ley = $bruto * 0.235;
    $neto = $bruto - $desc_ley;
    $presentismo = $neto * 0.0833;
    if($horas_sup != 0 && $horas_sec != 0){
        $totalpuntajeHC = $horas_sup * 15.10 + $horas_sec * 12.10 + $cargo_publico;
    }elseif($horas_sup == 0){
        $totalpuntajeHC = $horas_sec * 12.10 + $cargo_publico;
    }elseif($horas_sec == 0){
        $totalpuntajeHC = $horas_sup * 15.10 + $cargo_publico;
    }else{$totalpuntajeHC = $cargo_publico;}
    $totalpuntajeHC = $horas_sup * 15.10 + $horas_sec * 12.10 + $cargo_publico;
    $liquido = $neto + $presentismo + $transporte;
    if($totalpuntajeHC > 543){
        $bg = 'bg-primary';
        $msj = 'Supera el máximo por '.($totalpuntajeHC-543).' puntos';
    }else{
        $bg = 'bg-dark';
        $msj = '';
    }
@endphp
<title>Calculadora</title>
<h2>CALCULADORA</h2>
<table border="1" width="100%">
    <tbody>
        <tr>
            <td>
                Básico: {{ round($basico, 2) }}
                <br>Antigüedad: {{ round($antig, 2) }}
                <br>Título: {{ round($titulo, 2) }}
            </td>
            <td>
                <b>Bruto: {{ round($bruto, 2) }} </b>
            </td>
            <td rowspan="3">
                Total Puntaje HC: {{ round($totalpuntajeHC, 2) }}
                <br><br><small style="color:#ba0000">{{$msj}}</small>
            </td>
        </tr>
    
        <tr>
            <td>
                Descuentos de Ley: {{ round($desc_ley, 2) }}
            </td>
            <td>
                <b>Neto: {{ round($neto, 2) }} </b>
                <br><small>(Bruto - Desc. de Ley)</small>
            </td>
        </tr>
    
        <tr>
            <td>
                Presentismo: {{ round($presentismo, 2) }}
                <br>Transporte: {{ round($transporte, 2) }}
            </td>
            <td>
                <b>Líquido: {{ round($liquido, 2) }} </b>
                <br><small>(Neto + Presentismo + Transp.)</small>
            </td>
        </tr>
    </tbody>
</table>
