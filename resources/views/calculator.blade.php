@extends(backpack_view('blank'))

@section('content')

@php
    $jobs = App\Models\Job::where('score', '<>', 0.0)->get();
@endphp

<div class="container">
    <h1>Calculadora</h1>
    <div class="row">        
        <small class="col-12 mb-2 text-primary">Datos Obligatorios *</small>
        <div class="col-lg-4 col-12 form-group">
            <label for="exampleFormControlSelect1">Cargo<span class="text-primary">*</span></label>
            <select class="form-control" id="cargo">
                <option>Seleccione</option>
                @foreach ($jobs as $job)
                <option value="{{ $job->score }}">{{ $job->description }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="col-lg-4 col-12 form-group">
            <label for="exampleFormControlSelect2">Antigüedad<span class="text-primary">*</span></label>
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
            <label for="exampleFormControlSelect2">Título<span class="text-primary">*</span></label>
            <select class="form-control" id="titulo">
                <option>Seleccione</option>
                <option value="15">Habilitante</option>
                <option value="40">Específico</option>
            </select>
        </div>

        <div class="col-lg-4 col-12 form-group">
            <label for="exampleFormControlSelect2">Transporte<span class="text-primary">*</span></label>
            <select class="form-control" id="transporte">
                <option>Seleccione</option>
                <option value="20">Cargo - Zona A</option>
                <option value="50">Cargo - Zona B</option>
                <option value="0.83">HC - Zona A</option>
                <option value="2.83">HC - Zona b</option>
            </select>
        </div>
        
        <div class="col-lg-4 col-12 form-group">
            <label for="exampleFormControlTextarea1">Horas Cátedra Nivel Superior</label>
            <input class="form-control" id="horas_sup" type="number" value="0">
        </div>
        
        <div class="col-lg-4 col-12 form-group">
            <label for="exampleFormControlTextarea1">Horas Cátedra Nivel Secundario</label>
            <input class="form-control" id="horas_sec" type="number" value="0">
        </div>

        <div class="col-lg-4 col-12 form-check form-switch ml-3 mb-4">
            <input class="form-check-input" type="checkbox" id="cargo_publico" value="362">
            <label class="form-check-label" for="flexSwitchCheckDefault">Cargo Público</label>
        </div>
    </div>
    <div class="row"> 
        <div class="col-lg-4 col-12 form-group">
            <button type="button" class="btn btn-primary" onclick="calculation()">Calcular</button>
        </div>
    </div>

    <div id="result">    
    <div>
</div>

@endsection

<script>
    function calculation(){
        var valor_indice_2022 = 149.68;
        var cargo = $("#cargo").children("option:selected").val();
        if ($('#cargo_publico').prop('checked') ) {
            var cargo_publico = parseFloat($("#cargo_publico").val());    
        }else{
            var cargo_publico = 0;
        }
        if(cargo == 15.1){
            var horas_sup = parseFloat($("#horas_sup").val());
            var horas_sec = parseFloat($("#horas_sec").val());
            var basico = horas_sup * valor_indice_2022
            var transporte = $("#transporte").children("option:selected").val() * horas_sup * valor_indice_2022
        }else{
            var basico = cargo * valor_indice_2022
            var transporte = parseFloat($("#transporte").children("option:selected").val())
        }
        var antig = basico * $("#antig").children("option:selected").val();
        var titulo = valor_indice_2022 * $("#titulo").children("option:selected").val()
        var bruto = basico + antig + titulo
        var desc_ley = bruto * 0.235
        var neto = bruto - desc_ley
        var presentismo = neto * 0.0833
        if(horas_sup != undefined && horas_sec != undefined){
            var TotalpuntajeHC = horas_sup * 15.10 + horas_sec * 12.10 + cargo_publico
        }else{
            if(horas_sup == undefined && horas_sec != undefined){
                var TotalpuntajeHC = horas_sec * 12.10 + cargo_publico
            }else{
                if(horas_sec == undefined && horas_sup != undefined){
                    var TotalpuntajeHC = horas_sup * 15.10 + cargo_publico
                }else{var TotalpuntajeHC = cargo_publico}
            }
        }
        var liquido = neto + presentismo + transporte
        if(TotalpuntajeHC > 543){
            var bg = 'bg-primary'
            var msj = '<small>Supera el máximo por '+ parseFloat(TotalpuntajeHC-543) +' puntos</small>'
        }else{
            var bg = 'bg-dark'
            var msj = ''
        }
        if(cargo != 'Seleccione' && $("#antig").children("option:selected").val() != 'Seleccione' && $("#titulo").children("option:selected").val() != 'Seleccione' && $("#transporte").children("option:selected").val() != 'Seleccione'){
            $("#result").html(
                '<a href="calculator_pdf/'+
                    cargo+
                    '&'+$("#antig").children("option:selected").val()+
                    '&'+$("#titulo").children("option:selected").val()+
                    '&'+$("#transporte").children("option:selected").val()+
                    '&'+horas_sup+
                    '&'+horas_sec+
                    '&'+cargo_publico+
                '" target="blank">DESCARGAR PDF</a>'+
                '<div class="row mt-4">'+
                    '<div class="card bg-light mb-3 mx-2 col-12 col-lg-3">'+
                        '<div class="card-body">'+
                            'Básico: '+basico.toFixed(2)+
                            '<br>Antigüedad: '+antig.toFixed(2)+
                            '<br>Título: '+titulo.toFixed(2)+
                        '</div>'+
                    '</div>'+

                    '<div class="card bg-secondary mb-3 mx-2 col-12 col-lg-3">'+
                        '<div class="card-body">'+
                            '<br><h5>Bruto: '+bruto.toFixed(2)+'</h5>'+
                        '</div>'+
                    '</div>'+

                    '<div class="card text-white '+bg+' mb-3 mx-2 col-12 col-lg-3">'+
                        '<div class="card-body">'+
                            '<br>Total Puntaje HC: '+TotalpuntajeHC.toFixed(2)+
                            '<br>'+msj+
                        '</div>'+
                    '</div>'+
                '</div>'+

                '<div class="row">'+
                    '<div class="card bg-light mb-3 mx-2 col-12 col-lg-3">'+
                        '<div class="card-body">'+
                            'Descuentos de Ley: '+desc_ley.toFixed(2)+
                        '</div>'+
                    '</div>'+

                    '<div class="card bg-secondary mb-3 mx-2 col-12 col-lg-3">'+
                        '<div class="card-body">'+
                            '<h5>Neto: '+neto.toFixed(2)+'</h5>'+
                            '<small>(Bruto - Desc. de Ley)</small>'+
                        '</div>'+
                    '</div>'+
                '</div>'+

                '<div class="row">'+
                    '<div class="card bg-light mb-3 mx-2 col-12 col-lg-3">'+
                        '<div class="card-body">'+
                            'Presentismo: '+presentismo.toFixed(2)+
                            '<br>Transporte: '+transporte.toFixed(2)+
                        '</div>'+
                    '</div>'+

                    '<div class="card bg-secondary mb-3 mx-2 col-12 col-lg-3">'+
                        '<div class="card-body">'+
                            '<h5>Líquido: '+liquido.toFixed(2)+'</h5>'+
                            '<small>(Neto + Presentismo + Transp.)</small>'+
                        '</div>'+
                    '</div>'+
                '</div>'
            )  
        }else{alert('Debe completar los campos obligatorios *')}
    }
</script>