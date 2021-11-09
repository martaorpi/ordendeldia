@extends(backpack_view('blank'))

@section('content')
<div class="app-body">
    <main class="main">
      <!-- Breadcrumb-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Panel</li>
        <li class="breadcrumb-item"><a href="{{ backpack_url('estudiantes') }}">Estudiantes</a></li>
        <li class="breadcrumb-item active">{{$entry->last_name}}, {{$entry->first_name}}</li>
      </ol>
      <div class="container-fluid">
        <div class="animated fadeIn">
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <strong>Formulario de Inscripción</strong>
                        </div>
                        <div class="col-sm-6" align="right">
                            <button class="btn btn-success btn-sm pl-3 pr-3"><i class="nav-icon la la-check"></i> Aceptar</button>
                            <button class="btn btn-danger btn-sm pl-3 pr-3"><i class="nav-icon la la-close"></i> Rechazar</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="name">Apellido</label>
                        <input class="form-control" type="text" value=" {{ $entry->last_name }} " disabled>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="name">Nombre</label>
                        <input class="form-control" type="text" value=" {{ $entry->first_name }} " disabled>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="name">DNI</label>
                        <input class="form-control" type="text" value=" {{ $entry->dni }} " disabled>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="name">Dirección</label>
                        <input class="form-control" type="text" value=" {{ $entry->address }} " disabled>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="name">Nacionalidad</label>
                        <input class="form-control" type="text" value=" {{ $entry->nationality->description }} " disabled>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="name">Provincia</label>
                        <input class="form-control" type="text" value=" {{ $entry->province->description }} " disabled>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="name">Departamento</label>
                        <input class="form-control" type="text" value=" {{ $entry->department->description }} " disabled>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="name">Localidad</label>
                        <input class="form-control" type="text" value=" {{ $entry->location->description }} " disabled>
                      </div>
                    </div>
                    <div class="col-sm-12">
                        <hr>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="name">Carrera</label>
                        <input class="form-control" type="text" value=" {{ $entry->career->title }} " disabled>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="name">Ciclo</label>
                        <input class="form-control" type="text" value=" {{ $entry->cycle->denomination }} " disabled>
                      </div>
                    </div>
                    <div class="col-sm-12">
                        <hr>
                    </div>

                    @php
                        $documentation = \App\Models\Documentation::where('student_id', $entry->id)->get();    
                    @endphp

                    @foreach ($documentation as $document)
                        <div class="col-sm-4 p-2" align="center">
                            <div class="row">
                                <div class="col-sm-12">
                                    {{ $document->description }}
                                </div>   
                                <div class="col-sm-12">
                                    <a href="{{ url($document->src) }}" target="_blank">{{ $document->src }}</a>
                                </div>   
                            </div>   
                        </div>                            
                    @endforeach
                  </div>
                  <!-- /.row-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

@endsection