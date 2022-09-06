@extends(backpack_view('blank'))

@section('content')

@php
    $jobs = App\Models\Job::where('score', '<>', 0.0)->get();
    /*$basico = round($jobs->score * $valor_indice_2022, 2);
    $antig = round($basico * 0.30, 2);
    $titulo = 15 * $valor_indice_2022;*/
    //$basico_docente = round((15.1 * 3) * $valor_indice_2022, 2);
    //$antig_docente = round($basico_docente * 0.40, 2);
    //$licenses = App\Models\License::whereIn('id', [1, 2, 15, 32, 34, 35])->get();
    //$staff = App\Models\Staff::where('status', 'Activo')->get();
    //$jobs = DB::table('staff_subjects')->select('job_id', DB::raw('count(*) as total'))->groupBy('job_id')->get();
@endphp

<div class="container">
    <div class="row">        
        <div class="col-lg-4 col-12 form-group">
            <label for="exampleFormControlSelect1">Cargo</label>
            <select class="form-control" id="cargo">
                <option>Seleccione</option>
                @foreach ($jobs as $job)
                <option value="{{ $job->score }}">{{ $job->description }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="col-lg-4 col-12 form-group">
            <label for="exampleFormControlSelect2">Antigüedad</label>
            <select class="form-control" id="antig">
                <option>Seleccione</option>
                <option value="0.10">1</option>
                <option value="0.15">2</option>
                <option value="0.30">5</option>
                <option value="0.40">7</option>
                <option value="0.50">10</option>
                <option value="0.60">12</option>
                <option value="0.70">15</option>
                <option value="0.80">17</option>
                <option value="1.00">20</option>
                <option value="1.10">22</option>
                <option value="1.20">24</option>
            </select>
        </div>

        <div class="col-lg-4 col-12 form-group">
            <label for="exampleFormControlSelect2">Título</label>
            <select class="form-control" id="titulo">
                <option>Seleccione</option>
                <option value="15">Habilitante</option>
                <option value="40">Específico</option>
            </select>
        </div>

        <div class="col-lg-4 col-12 form-group">
            <label for="exampleFormControlSelect2">Transporte</label>
            <select class="form-control" id="titulo">
                <option>Seleccione</option>
                <option value="20">Cargo - Zona A</option>
                <option value="50">Cargo - Zona B</option>
                <option value="0.83">HC - Zona A</option>
                <option value="2.83">HC - Zona b</option>
            </select>
        </div>
        
        <div class="col-lg-4 col-12 form-group">
            <label for="exampleFormControlTextarea1">Horas Cátedra Nivel Superior</label>
            <input class="form-control" id="horas_sup" type="number">
        </div>
        
        <div class="col-lg-4 col-12 form-group">
            <label for="exampleFormControlTextarea1">Horas Cátedra Nivel Secundario</label>
            <input class="form-control" id="horas_sec" type="number">
        </div>
    </div>
    <div class="row"> 
        <div class="col-lg-4 col-12 form-group">
            <button type="button" class="btn btn-primary" onclick="calculation()">Calcular</button>
        </div>
    </div>

    <div id="result"><div>
</div>

@endsection

<script>
    function calculation(){
        var valor_indice_2022 = 149.68;
        var cargo = $("#cargo").children("option:selected").val();
        var horas_sup = $("#horas_sup").val() * 15.10;
        var horas_sec = $("#horas_sec").val() * 12.10;
        var basico = cargo * valor_indice_2022
        var transporte = 0
        if($("#cargo").children("option:selected").val() === 15.1){
            var transporte = $("#transporte").children("option:selected").val() * horas_sup * valor_indice_2022
            var basico = horas_sup * 15.1 * valor_indice_2022
        }
        var antig = basico * $("#antig").children("option:selected").val();
        var titulo = valor_indice_2022 * $("#titulo").children("option:selected").val()
        var bruto = basico + antig + titulo
        var desc_ley = bruto * 0.235
        var neto = bruto - desc_ley
        var presentismo = neto * 0.0833
        var TotalpuntajeHC = horas_sup +horas_sec
        var liquido = neto + presentismo + transporte
        $("#result").html(
            'Básico: '+basico.toFixed(2)+
            '<br>Antigüedad: '+antig.toFixed(2)+
            '<br>Título: '+titulo.toFixed(2)+
            '<br>Total Bruto: '+bruto.toFixed(2)+
            '<br>Descuentos de Ley: '+desc_ley.toFixed(2)+
            '<br>Total Neto: '+neto.toFixed(2)+
            '<br>Presentismo: '+presentismo.toFixed(2)+
            '<br>Transporte: '+transporte.toFixed(2)+
            '<br>Total Líquido: '+liquido.toFixed(2)+
            '<br><br>Total Puntaje HC: '+TotalpuntajeHC.toFixed(2)
        )  
    }
</script>