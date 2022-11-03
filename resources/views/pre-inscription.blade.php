<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


{{--<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js"></script> 
<script type="text/javascript" src="http://cdn.bootcss.com/bootstrap-select/2.0.0-beta1/js/bootstrap-select.js"></script>    
<link rel="stylesheet" type="text/css" href="http://cdn.bootcss.com/bootstrap-select/2.0.0-beta1/css/bootstrap-select.css">    
  
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">  
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>  --}}


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
    $careers = App\Models\Career::with('students_with_space')->get();
    
    $nacionalidades = App\Models\Nationality::get();
    $provincias = App\Models\Province::get();
    $departamentos = App\Models\Department::get();
    $estudiante = App\Models\Student::where('user_id', auth()->user()->id)->with(['career','province','department','nationality','documentation'])->first();
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
                    @foreach ($careers as $key => $career)
                        {{$career}}
                        @if ($career->status == 'Abierta')
                            @if ($career->available_space > $career->students_with_space->count())
                                @if ($estudiante)
                                    <option value="{{ $career->id }}" {{($estudiante->career_id==$career->id)? 'selected':''}}>{{ $career->title }}</option>
                                @else
                                    <option value="{{ $career->id }}">{{ $career->title }} </option>
                                @endif
                            @else
                                <option value="{{ $career->id }}" {{(old('career_id')==$career->id)? 'selected':''}} disabled>{{ $career->title }} {{$career->available_space}} <i>(Sin Cupo)</i></option>
                            @endif
                        @else
                            <option value="{{ $career->id }}" {{(old('career_id')==$career->id)? 'selected':''}} disabled>{{ $career->title }} <i>(Cerrada)</i></option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div id="ts" class="col-12 text-danger mt-2"></div>
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
                @if ($estudiante)
                    <input type="text" class="form-control" id="apellido" name="last_name" value="{{ $estudiante->last_name }}" required>
                @else
                    <input type="text" class="form-control" id="apellido" name="last_name" value="{{ old('last_name') }}" required>
                @endif
            </div>

            <div class="col-12 col-lg-6">
                <label for="nombre">Nombres (Completo)</label>
                @if ($estudiante)
                    <input type="text" class="form-control" id="nombre" name="first_name" value="{{ $estudiante->first_name }}" required>
                @else
                    <input type="text" class="form-control" id="nombre" name="first_name" value="{{ old('first_name')}}" required>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12 col-lg-6">
                <label for="dni">D.N.I. Nº</label>
                @if ($estudiante)
                    <input type="number" class="form-control" id="dni" name="dni" value="{{ $estudiante->dni }}" required>
                @else
                    <input type="number" class="form-control" id="dni" name="dni" value="{{ old('dni')}}" required>
                @endif
            </div>

            <div class="col-12 col-lg-6">
                <label for="fecha_nac">Fecha de Nacimiento</label>
                @if ($estudiante)
                    <input type="date" class="form-control" id="fecha_nac" name="date_birth" value="{{ $estudiante->date_birth }}" required>
                @else
                    <input type="date" class="form-control" id="fecha_nac" name="date_birth" value="{{ old('date_birth')}}" required>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12 col-lg-6">
                <label for="fijp">Teléfono Fijo</label>
                @if ($estudiante)
                    <input type="text" class="form-control" id="fijp" name="landline" value="{{ $estudiante->landline }}" required>
                @else
                    <input type="text" class="form-control" id="fijp" name="landline" value="{{ old('landline')}}" required>
                @endif
            </div>

            <div class="col-12 col-lg-6">
                <label for="celular">Teléfono Celular</label>
                @if ($estudiante)
                    <input type="text" class="form-control" id="celular" name="cell_phone" value="{{ $estudiante->cell_phone }}" required>
                @else
                    <input type="text" class="form-control" id="celular" name="cell_phone" value="{{ old('cell_phone')}}" required>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <label for="nacionalidad">Nacionalidad</label>
                <select class="form-control selectpicker" data-live-search="true" id="nacionalidad" name="nationality_id" required>
                    <option value="">Seleccione</option>
                    @foreach ($nacionalidades as $nacionalidad)
                        @if ($estudiante)
                            <option value="{{ $nacionalidad->id }}" {{($estudiante->nationality_id==$nacionalidad->id)? 'selected':''}}>{{ $nacionalidad->description }}</option>
                        @else
                            <option value="{{ $nacionalidad->id }}" {{(old('nationality_id')==$nacionalidad->id)? 'selected':''}}>{{ $nacionalidad->description }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="form-group row">
            <div class="col-12">
                <hr class="linea_bordo mb-4">
                <h6><b>DOMICILIO REAL (Domicilio en el que reside actualmente)</b></h6>
            </div>
        </div>

        <div class="form-group row">
            
            <div class="col-12">
                <label for="provincia">Provincia</label>
                <select class="form-control selectpicker" data-live-search="true" id="provincia" name="province_id" disabled>
                    <option value="">Seleccione</option>
                    @foreach ($provincias as $provincia)
                        @if ($estudiante)
                            <option value="{{ $provincia->id }}" {{($estudiante->province_id==$provincia->id)? 'selected':''}}>{{ $provincia->description }}</option>
                        @else
                            <option value="{{ $provincia->id }}" {{(old('province_id')==$provincia->id)? 'selected':''}}>{{ $provincia->description }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <label for="departamento">Departamento</label>
                <select class="form-control selectpicker" data-live-search="true" id="departamento" name="department_id" disabled>
                    <option value="">Seleccione</option>
                    @foreach ($departamentos as $departamento)
                        @if ($estudiante)
                            <option value="{{ $departamento->id }}" {{($estudiante->department_id==$departamento->id)? 'selected':''}}>{{ $departamento->description }}</option>
                        @else
                            <option value="{{ $departamento->id }}" {{(old('department_id')==$departamento->id)? 'selected':''}}>{{ $departamento->description }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <label for="localidad">Localidad</label>
                <select class="form-control selectpicker" data-live-search="true" id="localidad" name="location_id" disabled>
                    @if ($estudiante)
                        <option value="{{ $estudiante->location_id }}">{{ $estudiante->location->description }}</option>
                    @else
                        <option value="">Seleccione</option>
                    @endif
                </select>
            </div>
        </div>
        
        <div class="form-group row">
            <div class="col-12">
                <label for="direccion">Dirección</label>
                @if ($estudiante)                    
                    <textarea class="form-control" id="direccion" name="address" required>{{ $estudiante->address }}</textarea>
                @else
                    <textarea class="form-control" id="direccion" name="address" required>{{ old('address')}}</textarea>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <hr class="linea_bordo mb-4">
                <h6><b>DOMICILIO LEGAL (Domicilio que figura en su DNI)</b></h6>
            </div>
        </div>

        <div class="form-group row">
            
            <div class="col-12">
                <label for="provinciaL">Provincia</label>
                <select class="form-control selectpicker" data-live-search="true" id="provinciaL" name="province_legal_id" disabled>
                    <option value="">Seleccione</option>
                    @foreach ($provincias as $provincia)
                        @if ($estudiante)
                            <option value="{{ $provincia->id }}" {{($estudiante->province_legal_id==$provincia->id)? 'selected':''}}>{{ $provincia->description }}</option>
                        @else
                            <option value="{{ $provincia->id }}" {{(old('province_legal_id')==$provincia->id)? 'selected':''}}>{{ $provincia->description }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <label for="departamentoL">Departamento</label>
                <select class="form-control selectpicker" data-live-search="true" id="departamentoL" name="department_legal_id" disabled>
                    <option value="">Seleccione</option>
                    @foreach ($departamentos as $departamento)
                        @if ($estudiante)
                            <option value="{{ $departamento->id }}" {{($estudiante->department_legal_id==$departamento->id)? 'selected':''}}>{{ $departamento->description }}</option>
                        @else
                            <option value="{{ $departamento->id }}" {{(old('department_legal_id')==$departamento->id)? 'selected':''}}>{{ $departamento->description }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <label for="localidadL">Localidad</label>
                <select class="form-control selectpicker" data-live-search="true" id="localidadL" name="location_legal_id" disabled>
                    @if ($estudiante)
                        <option value="{{ $estudiante->location_legal_id }}">{{ $estudiante->location->description }}</option>
                    @else
                        <option value="">Seleccione</option>
                    @endif
                </select>
            </div>
        </div>
        
        <div class="form-group row">
            <div class="col-12">
                <label for="direccionL">Dirección</label>
                @if ($estudiante)                    
                    <textarea class="form-control" id="direccionL" name="address_legal" required>{{ $estudiante->address_legal }}</textarea>
                @else
                    <textarea class="form-control" id="direccionL" name="address_legal" required>{{ old('address_legal')}}</textarea>
                @endif
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
                @if ($estudiante)
                    <input type="file" class="form-control-file" name="files[]" multiple>
                    @php 
                        $file_calificaion_estudiante = $estudiante->documentation->where('description', 'Certificado de Estudios')->last()->src;
                        $file = explode('/',$file_calificaion_estudiante);
                    @endphp
                    <a href="{{ $file_calificaion_estudiante }}">{{ $file[3] }}</a>
                @else
                    <input type="file" class="form-control-file" name="files[]" multiple value="{{ old('files[]') }}" required>
                @endif
                    <input type="hidden" value="Certificado de Estudios" name="description0">

            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <hr class="linea_bordo">
            </div>
        </div>

        <div class="form-group row">

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" style="overflow-y: scroll; height:400px;">
                        <p><b>COMPROMISO CON LA INSTITUCION</b></p>
                        <p>Por medio de la presente, declaro conocer y aceptar todas las disposiciones académicas y disciplinarias de los reglamentos del Instituto San Martin de Porres, como así también las condiciones de matriculación, abono de cuota y otros conceptos. asi como otras resoluciones que emita la  autoridad competente y comprometo a respetarlos estrictamente.</p>
                        <br>
                        <p><b>INFORMACION IMPORTATEN A TENER EN CUENTA</b></p>
                        <P>*La inscripción será validada a partir del momento en que se acredite el pago de dicho arancel. Sea en el instituto o en la entidad financiera correspondiente, dentro de las fechas establecidas por la institución y la presentación de la documentación correspondiente.</P>
                        <br>
                        <p>*Por el pago de la inscripción el ingresante tiene derecho a realizar el taller propedéutico <b>NO SIENDO EL MONTO REINTEGRABLE POR NINGÚN CONCEPTO.</b> El ingresante adquiere la condición de estudiante regular por el pago de la matrícula completa, la realización del taller propedéeutico y la presentación de todos los requisitos establecidos por la institución</p>
                        <br>
                        <p>*Los montos fijados para las cuotas mensuales pueden ser modificadas por el instituto a lo largo del ciclo electivo, en caso de que haya una variación significativa en la estructura de costos internos.</p>
                        <br>
                        <p><b>Declaro Bajo Fe de Juramento que la documentación que acompaño digitalmente es verdadera, conociendo las disposiciones del titulo XII (delitos contra la fé pública) Capítulo III (falsificación de documentos) del Código Penal Argentino.</b></p>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="terminos" onchange="toggleCheckbox(this)" disabled>
                            <label class="form-check-label pl-4" for="terminos">
                               He leído y aceptado de Conformidad
                               
                            </label>
                            
                        </div>
                        
                    </div>
                  </div>
                </div>
            </div>






           
            <div class="login-horizental cancel-wp pull-left">

                        <a href = "#" data-toggle="modal" data-target="#exampleModal">
                            Terminos y condiciones 
                        </a>
            </div>
        </div>
        
        <button type="submit" class="btn btn_bordo text-white btn-block" disabled="true" id="btn-actualizar">Enviar</button>
    </form>
</div>


<script>
    $(function() {
        if(document.getElementById('nacionalidad').value == 1){
            $("#provincia").attr('disabled',false);
            $("#provinciaL").attr('disabled',false);
            //$('#provincia').selectpicker('refresh');
        }
        
        if(document.getElementById('provincia').value == 1){
            $("#departamento").attr('disabled',false);
            $("#departamento").prop('required',true);

            $("#localidad").attr('disabled',false);
            $("#localidad").prop('required',true);
        }

        if(document.getElementById('provinciaL').value == 1){
            $("#departamentoL").attr('disabled',false);
            $("#departamentoL").prop('required',true);

            $("#localidadL").attr('disabled',false);
            $("#localidadL").prop('required',true);
        }

        $("#nacionalidad").change( function(event) {
            if ($(this).val() == 1) {
                $("#provincia").attr('disabled',false);
                $("#provincia").prop('required',true);

                $("#provinciaL").attr('disabled',false);
                $("#provinciaL").prop('required',true);
             
                if(document.getElementById('provincia').value == 1){
                    $("#departamento").attr('disabled',false);
                    $("#departamento").prop('required',true);

                    $("#localidad").attr('disabled',false);
                    $("#localidad").prop('required',true);
                }

                if(document.getElementById('provinciaL').value == 1){
                    $("#departamentoL").attr('disabled',false);
                    $("#departamentoL").prop('required',true);

                    $("#localidadL").attr('disabled',false);
                    $("#localidadL").prop('required',true);
                }
            } else {
                $("#provincia").attr('disabled',true);
                $('#provincia').selectpicker('refresh');

                $("#provinciaL").attr('disabled',true);
                $('#provinciaL').selectpicker('refresh');

                $("#departamento").attr('disabled',true);
                $("#departamentoL").attr('disabled',true);

                $("#localidad").attr('disabled',true);
                $("#localidadL").attr('disabled',true);
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

                $("#localidad").attr('disabled',true);
            }
        });

        $("#provinciaL").change(function(event){
            if ($(this).val() == 1) {
                $("#departamentoL").attr('disabled',false);
                $("#departamentoL").prop('required',true);

                $("#localidadL").attr('disabled',false);
                $("#localidadL").prop('required',true);
            } else {
                $("#departamentoL").attr('disabled',true);

                $("#localidadL").attr('disabled',true);
            }
        });

        $("#departamento").change(function(event){
            $("#localidad").attr('disabled',false);
            $.get("getLocalidades/"+event.target.value,function(response,indicador){
                $("#localidad").empty();
                for(i=0; i<response.length; i++){
                    $("#localidad").append("<option value='"+response[i].id+"'>"+response[i].description+"</option>");
                }
            });
        });

        $("#departamentoL").change(function(event){
            $("#localidadL").attr('disabled',false);
            $.get("getLocalidades/"+event.target.value,function(response,indicador){
                $("#localidadL").empty();
                for(i=0; i<response.length; i++){
                    $("#localidadL").append("<option value='"+response[i].id+"'>"+response[i].description+"</option>");
                }
            });
        });

        $("#carrera").change(function(event){
            if ($(this).val() == 1) {
                $("#ts").html('La carrera de Trabajo Social tiene una duración de 4 años.'+
                            '<br>'+
                            ' Con la posibilidad de articular con el cilco complemetario de UNSTA (Universidad del Norte Santo Tomás de Aquino), de 2 años más de duración, para obtener el título de Lic. en Trabajo Social.')
            }else{
                $('#ts').html('');
            }
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