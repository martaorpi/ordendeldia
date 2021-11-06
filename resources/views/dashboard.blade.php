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
@endphp

<html>
    <head>
        <title>Formulario Preinscripcion</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.0/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <x-app-layout>
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Dashboard') }}
                    </h2>
                </x-slot>
                <div class="mx-5 px-5 my-5">
                    <h1 class="text-center"><b>FORMULARIO DE PREINSCRIPCIÓN</b></h1><br>
                    
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
                                <hr class="linea_bordo mb-5">
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
                                <hr class="linea_bordo mb-5">
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
                                <hr class="linea_bordo mb-5">
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
                                <label>2- Certificados de Estudios Secundarios (copia) o constancia de finalización de estudios sin adeudar materias.</label>
                            </div>
                
                            <div class="col-12 col-lg-4">
                                <input type="file" class="form-control-file" name="files[]" multiple value="{{ old('files[]') }}" required>
                            </div>
                        </div>
                
                        <div class="form-group row">
                            <div class="col-12 col-lg-8">
                                <label>3- Fotocopia de DNI (actualizado) frente y reverso.</label>
                            </div>
                
                            <div class="col-12 col-lg-4">
                                <input type="file" class="form-control-file" name="files[]" multiple value="{{ old('files[]') }}" required>
                            </div>
                        </div>
                
                        <div class="form-group row">
                            <div class="col-12 col-lg-8">
                                <label>7- Tres (3) Fotos Carnet color (4 x 4).</label>
                            </div>
                
                            <div class="col-12 col-lg-4">
                                <input type="file" class="form-control-file" name="files[]" multiple value="{{ old('files[]') }}" required>
                            </div>
                        </div>
                
                        <div class="form-group row">
                            <div class="col-12">
                                <b>NOTA: Declaro Bajo Fe de Juramento que la documentación que acompaño digitalmente es verdadera, conociendo las disposiciones del Titulo XII (delitos contra la fe pública) Capitulo III (falsificación de documentos) del Código Penal.</b>
                            </div>
                        </div>
                
                        <div class="form-group row">
                            <div class="col-12">
                                <b>OBSERVACIONES: También se deja aclarado que los documentos en formato papel, serán requeridos por la institución en fechas a confirmar.</b>
                            </div>
                        </div>
                
                        <div class="form-group row">
                            <div class="col-12">
                                <hr class="linea_bordo mb-5">
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn_bordo text-white btn-block">Enviar</button>
                    </form>
                </div>
            </x-app-layout>
        </div>
    </body>

</html>


