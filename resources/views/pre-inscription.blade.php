<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
    button.btn.dropdown-toggle.btn-default {
        background-color: #fff !important;
        margin:0;
        box-shadow: none;
    }
    button.btn.dropdown-toggle.btn-default:hover {
        background-color: #fff !important;
    }
    span.caret{margin:-2px -2px 0 0 !important;}
    .btn.dropdown-toggle.bs-placeholder.btn-light{
        padding: 15px 5px 10px 15px;
        margin:0;
        background-color: #fff !important;
        box-shadow: none;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        color: #000 !important;
    }
    .btn-light.dropdown-toggle {
        padding: 15px 5px 10px 15px;
        margin:0;
        background-color: #fff !important;
        box-shadow: none;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        color: #000 !important;
    }
    .filter-option-inner-inner {
        margin-top: -10px !important;
    }
    .linea_bordo{
        border: solid 1px #881f1f;
    }
    .btn_bordo{
        background: #881f1f !important;
    }
</style>

@php
    $carreras = App\Models\Career::get();
    $nacionalidades = App\Models\Nationality::get();
    $provincias = App\Models\Province::get();
    $departamentos = App\Models\Department::get();
    //$localidades = App\Models\Location::orderBy('description', 'asc')->get();
@endphp

<div class="mx-5 px-5 my-5">
    <h3 class="text-center"><b>FORMULARIO DE PREINSCRIPCIÓN</b></h3><br>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <p>Corrige los siguientes errores:</p>
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ url('formulario-inscripcion') }}" class="" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <div class="col-12">
                <hr class="linea_bordo">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <label for="carrera">Carrera Nivel Superior No Universitario</label>
                <select class="form-control" id="carrera" name="career_id" required>
                    <option value="">Seleccione</option>
                    @foreach ($carreras as $carrera)
                        <option value="{{ $carrera->id }}" {{(old('career_id')==$carrera->id)? 'selected':''}}>{{ $carrera->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <hr class="linea_bordo mb-4">
                <h6><b>DATOS PERSONALES</b></h6>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12 col-lg-6">
                <label for="apellido">Apellidos (Completo)</label>
                <input type="text" class="form-control" id="apellido" name="last_name" value="{{ old('last_name')}}" required>
            </div>

            <div class="col-12 col-lg-6">
                <label for="nombre">Nombres (Completo)</label>
                <input type="text" class="form-control" id="nombre" name="first_name" value="{{ old('first_name')}}" required>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12 col-lg-6">
                <label for="dni">D.N.I. Nº</label>
                <input type="number" class="form-control" id="dni" name="dni" value="{{ old('dni')}}" required>
            </div>
        </div>
        
        <div class="form-group row">
            <div class="col-12">
                <hr class="linea_bordo mb-4">
                <h6><b>DIRECCION</b></h6>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12 col-lg-6">
                <label for="nacionalidad">Nacionalidad</label>
                <select class="form-control selectpicker" data-live-search="true" id="nacionalidad" name="nationality_id" required>
                    <option value="">Seleccione</option>
                    @foreach ($nacionalidades as $nacionalidad)
                        <option value="{{ $nacionalidad->id }}" {{(old('nationality_id')==$nacionalidad->id)? 'selected':''}}>{{ $nacionalidad->description }}</option>
                    @endforeach
                </select>
            </div>
        
            <div class="col-12 col-lg-6">
                <label for="provincia">Provincia</label>
                <select class="form-control selectpicker" data-live-search="true" id="provincia" name="province_id" disabled>
                    <option value="">Seleccione</option>
                    @foreach ($provincias as $provincia)
                        <option value="{{ $provincia->id }}" {{(old('province_id')==$provincia->id)? 'selected':''}}>{{ $provincia->description }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12 col-lg-6">
                <label for="departamento">Departamento</label>
                <select class="form-control selectpicker" data-live-search="true" id="departamento" name="department_id" disabled>
                    <option value="">Seleccione</option>
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento->id }}" {{(old('department_id')==$departamento->id)? 'selected':''}}>{{ $departamento->description }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-lg-6">
                <label for="localidad">Localidad</label>
                <select class="form-control selectpicker" data-live-search="true" id="localidad" name="location_id" disabled>
                    <option value="">Seleccione</option>
                </select>
            </div>
        </div>
        
        <div class="form-group row">
            <div class="col-12">
                <label for="direccion">Dirección</label>
                <textarea class="form-control" id="direccion" name="address" required>{{ old('address')}}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <hr class="linea_bordo mb-3">
                <h6><b>REQUISITOS</b></h6>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <b>Adjunte la documentación requerida: (sólo puede adjuntar archivos en formatos png, jpg, jpeg y pdf)</b>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12 col-lg-8">
                <label>1- Certificados de Estudios Secundarios (copia) o constancia de finalización de estudios sin adeudar materias.</label>
            </div>

            <div class="col-12 col-lg-4">
                <input type="file" class="form-control-file" name="files[]" multiple value="{{ old('files[]') }}" required>
                <input type="hidden" value="Certificado de Estudios" name="description0">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12 col-lg-8">
                <label>2- Fotocopia de DNI (actualizado) frente y reverso.</label>
            </div>

            <div class="col-12 col-lg-4">
                <input type="file" class="form-control-file" name="files[]" multiple value="{{ old('files[]') }}" required>
                <input type="hidden" value="Fotocopia de DNI" name="description1">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12 col-lg-8">
                <label>3- Foto Carnet color (4 x 4).</label>
            </div>

            <div class="col-12 col-lg-4">
                <input type="file" class="form-control-file" name="files[]" multiple value="{{ old('files[]') }}" required>
                <input type="hidden" value="Foto Carnet" name="description2">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <hr class="linea_bordo">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12">
                <p><b>COMPROMISO CON LA INSTITUCION</b></p>
                <p>Por medio de la presente, declaro conocer y aceptar todas las disposiciones academicas y diciplinarias de los reglamentos del instituto San Martin de Porres, como asi tambien las condiciones de matriculacion, abono de cuota y otros conceptos. asi como otras resoluciones que emita la  autoridad competente y comprometo a respetarlos estrictamente.</p>
                <br>
                <p><b>INFORMACION IMPORTATEN A TENER EN CUENTA</b></p>
                <P>*La inscripcion sera validada a partir del momento en que se acredite el pago de dichp arancel. sea en el instituto o en la entidad financiera correspondiente, dentro de las fechas establecidas por la institucion y la presentacion de la documentacion correspondiente.</P>
                <br>
                <p>*Por el pago de la inscripcion el ingresante tiene derecho a realizar el taller propedeutico <b>NO SIENDO EL MONTO REINTEGRABLE POR NINGUN CONCEPTO.</b> El ingresante adquiere la condicion de estudiante regular por el pago de la matricula completa, la realizacion del taller propedeutico y la presentacion de todos los requisitos establecidos por la institucion</p>
                <br>
                <p>*Los montos fijados para las cuotas mensuales pueden ser modificadas por el instituto a lo largo del ciclo electivo, en caso de que haya una variacion significativa en la estructura de costos internos.</p>
                <br>
                <p><b>Declaro Bajo Fe de Juramento que la documentacion que acompaño digitalmente es verdadera, conociendo las disposiciones del titulo XII (delitos contra la fe publica) Capitulo III (falsificacion de documentos) del Codigo Penal.</b></p>
                <br>
                <div class="login-horizental cancel-wp pull-left">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="terminos" onchange="toggleCheckbox(this)">
                        <label class="form-check-label pl-4" for="flexCheckDefault">
                            He leido y aceptado de Conformidad
                        </label>
                    </div>
                </div>
                <br>
                <div class="pull-right">
                    <p><b>Anexo 1 de la presente</b></p>
                    <p><a target="_blank" href="http://synergysoft.host/porres/archivos/ORGANIGRAMA_ISMP.pdf">Organigrama Institucional</a></p>
                    <p><a target="_blank" href="http://ismp.org.ar/files/Reglamento-ISMP.pdf">Reglamento Institucional</a></p>
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn_bordo text-white btn-block" disabled="true" id="btn-actualizar">Enviar</button>
    </form>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(function() {
        if(document.getElementById('nacionalidad').value == 1){
            $("#provincia").attr('disabled',false);
            //$('#provincia').selectpicker('refresh');
        }
        
        if(document.getElementById('provincia').value == 1){
            $("#departamento").attr('disabled',false);
            $("#departamento").prop('required',true);

            $("#localidad").attr('disabled',false);
            $("#localidad").prop('required',true);
        }

        $("#nacionalidad").change( function(event) {
            if ($(this).val() == 1) {
                $("#provincia").attr('disabled',false);
                $("#provincia").prop('required',true);
             
                if(document.getElementById('provincia').value == 1){
                    $("#departamento").attr('disabled',false);
                    $("#departamento").prop('required',true);

                    $("#localidad").attr('disabled',false);
                    $("#localidad").prop('required',true);
                }
            } else {
                $("#provincia").attr('disabled',true);
                //$('#provincia').selectpicker('refresh');

                $("#departamento").attr('disabled',true);
                //$('#departamento').selectpicker('refresh');

                $("#localidad").attr('disabled',true);
                //$('#localidad').selectpicker('refresh');
            }
        });
 
        $("#provincia").change(function(event){
            if ($(this).val() == 1) {
                $("#departamento").attr('disabled',false);
                $("#departamento").prop('required',true);

                $("#localidad").attr('disabled',false);
                $("#localidad").prop('required',true);
            } else {
                $("#departamento").attr('disabled',true);
                //$('#departamento').selectpicker('refresh');

                $("#localidad").attr('disabled',true);
                //$('#localidad').selectpicker('refresh');
            }
        });

        $("#departamento").change(function(event){
            $("#localidad").attr('disabled',false);
            $("#localidad").prop('required',true);
            $.get("getLocalidades/"+event.target.value,function(response,indicador){
                $("#localidad").empty();
                for(i=0; i<response.length; i++){
                    $("#localidad").append("<option value='"+response[i].id+"'>"+response[i].description+"</option>");
                }
                //$('#localidad').selectpicker('refresh');
            });
        });
    });

    function toggleCheckbox(element)
    {
        if (element.checked) {
            document.getElementById("btn-actualizar").disabled = false;
        }else{
            document.getElementById("btn-actualizar").disabled = true;            
        }
    }
</script>