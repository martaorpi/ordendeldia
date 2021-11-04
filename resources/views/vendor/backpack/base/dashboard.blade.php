@extends(backpack_view('blank'))

@section('content')
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
/*$departamentos = App\Models\OldDepartament::get();
$localidades = App\Models\OldLocality::get();*/
@endphp

<div class="mx-5 px-5 my-5">
    <h3 class="text-center">FORMULARIO DE PREINSCRIPCIÓN</h3><br>
    
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
                <select class="form-control" id="carrera" name="id_carrera" required>
                    <option value="">Seleccione</option>
                    @foreach ($carreras as $carrera)
                        <option value="{{ $carrera->id }}" {{(old('id_carrera')==$carrera->id)? 'selected':''}}>{{ $carrera->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <hr class="linea_bordo">
                <h6><b>DATOS PERSONALES</b></h6>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12 col-lg-6">
                <label for="apellido">Apellidos (Completo)</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido')}}" required>
            </div>

            <div class="col-12 col-lg-6">
                <label for="nombre">Nombres (Completo)</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre')}}" required>
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
                <hr class="linea_bordo">
                <h6><b>DIRECCION</b></h6>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12 col-lg-6">
                <label for="nacionalidad">Nacionalidad</label>
                <select class="form-control selectpicker" data-live-search="true" id="nacionalidad" name="id_nacionalidadNac" required>
                    <option value="">Seleccione</option>
                    @foreach ($nacionalidades as $nacionalidad)
                        <option value="{{ $nacionalidad->id_nacionalidad }}" {{(old('id_nacionalidadNac')==$nacionalidad->id_nacionalidad)? 'selected':''}}>{{ $nacionalidad->denominacion }}</option>
                    @endforeach
                </select>
            </div>
        
            <div class="col-12 col-lg-6">
                <label for="provincia">Provincia</label>
                <select class="form-control selectpicker" data-live-search="true" id="provincia" name="id_provinciaNac" disabled>
                    <option value="">Seleccione</option>
                    @foreach ($provincias as $provincia)
                        <option value="{{ $provincia->id_provincia }}" {{(old('id_provinciaNac')==$provincia->id_provincia)? 'selected':''}}>{{ $provincia->descripcion }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12 col-lg-6">
                <label for="localidad">Localidad</label>
                <select class="form-control selectpicker" data-live-search="true" id="localidad" name="id_localidadNac" disabled>
                    <option value="">Seleccione</option>
                </select>
            </div>
        </div>
        
        <div class="form-group row">
            <div class="col-12">
                <label for="direccion">Dirección</label>
                <textarea class="form-control" id="direccion" name="direccionReal" required>{{ old('direccionReal')}}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <hr class="linea_bordo">
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
                <hr class="linea_bordo">
            </div>
        </div>
        
        <button type="submit" class="btn btn_bordo text-white btn-block">Enviar</button>
    </form>
</div>

@endsection