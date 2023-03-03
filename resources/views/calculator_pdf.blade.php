<style>
    td{padding:20px;}
    .titulo{margin: 0 auto;}
</style>

@php
    $param = explode('&',$param);
    $valor_indice_2022 = 149.68;
    $cargo = $param[0];
    $antig = $param[1];
    $titulo = $param[2];
    $transporte = $param[3];
    $cargo_publico = $param[6];

    $job = App\Models\Job::where('score', '=', $cargo)->first();

    switch($antig){
        case 0: $antig_desc = '0 año'; break;
        case 0.10: $antig_desc = '1 año'; break;
        case 0.15: $antig_desc = '2-4 años'; break;
        case 0.30: $antig_desc = '5-6 años'; break;
        case 0.40: $antig_desc = '7-9 años'; break;
        case 0.50: $antig_desc = '10-11 años'; break;
        case 0.60: $antig_desc = '12-14 años'; break;
        case 0.70: $antig_desc = '15-16 años'; break;
        case 0.80: $antig_desc = '17-19 años'; break;
        case 1.00: $antig_desc = '20-21 años'; break;
        case 1.10: $antig_desc = '22-23 años'; break;
        case 1.20: $antig_desc = '24 años'; break;
    }

    switch($titulo){
        case 0: $titulo_desc = 'No corresponde'; break;
        case 15: $titulo_desc = 'Habilitante'; break;
        case 40: $titulo_desc = 'Específico'; break;
    }

    switch($transporte){
        case 20: $transporte_desc = 'Cargo - Zona A'; break;
        case 50: $transporte_desc = 'Cargo - Zona B'; break;
        case 0.83: $transporte_desc = 'HC - Zona A'; break;
        case 2.83: $transporte_desc = 'HC - Zona B'; break;
    }

    if($param[4] == 'undefined'){$hs_sup_desc = 0;}else{$hs_sup_desc = $param[4];}
    if($param[5] == 'undefined'){$hs_sec_desc = 0;}else{$hs_sec_desc = $param[5];}

    switch($cargo_publico){
        case 0: $cargo_publico_desc = 'No'; break;
        case 362: $cargo_publico_desc = 'Si'; break;
    }

    if($cargo == 15.1){
        $horas_sup = $param[4];
        $horas_sec = $param[5];
        $basico = $horas_sup * $valor_indice_2022 * $cargo;
        $transporte = $transporte * $horas_sup * $valor_indice_2022;
        if($horas_sup != 0 && $horas_sec != 0){
            $totalpuntajeHC = $horas_sup * 15.10 + $horas_sec * 12.10 + $cargo_publico;
        }elseif($horas_sup == 0){
            $totalpuntajeHC = $horas_sec * 12.10 + $cargo_publico;
        }elseif($horas_sec == 0){
            $totalpuntajeHC = $horas_sup * 15.10 + $cargo_publico;
        }else{$totalpuntajeHC = $cargo_publico;}
    }else{
        $horas_sup = 0;
        $horas_sec = 0;
        $basico = $cargo * $valor_indice_2022;
        $transporte = $transporte * $valor_indice_2022;
        $totalpuntajeHC = $cargo + $cargo_publico;
    }
    $antig = $basico * $antig;
    $titulo = $valor_indice_2022 * $titulo;
    $bruto = $basico + $antig + $titulo;
    $desc_ley = $bruto * 0.235;
    $neto = $bruto - $desc_ley;
    $presentismo = $neto * 0.0833;
    
    //$totalpuntajeHC = $horas_sup * 15.10 + $horas_sec * 12.10 + $cargo_publico;
    $liquido = $neto + $presentismo + $transporte;
    if($totalpuntajeHC > 543){
        $bg = 'bg-primary';
        $msj = 'Supera el máximo por '.($totalpuntajeHC-543).' puntos';
    }else{
        $bg = 'bg-dark';
        $msj = '';
    }
@endphp
<title class="titulo">Calculadora</title>
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
<hr>
<h4>DATOS</h4>
<b>Cargo: </b>{{ $job->description }} ({{ $param[0] }})<br>
<b>Antigüedad: </b>{{ $antig_desc }} ({{ $param[1] }})<br>
<b>Título: </b>{{ $titulo_desc }} ({{ $param[2] }})<br>
<b>Transporte: </b>{{ $transporte_desc }} ({{ $param[3] }})<br>
<b>Horas Nivel Sup.: </b>{{ $hs_sup_desc }}<br>
<b>Horas Nivel Sec.: </b>{{ $hs_sec_desc }}<br>
<b>Cargo Público: </b>{{ $cargo_publico_desc }} ({{ $param[6] }})<br>