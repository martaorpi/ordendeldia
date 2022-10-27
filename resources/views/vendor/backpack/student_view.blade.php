@extends(backpack_view('blank'))
@section('content')

<div class="app-body">
    <main class="main">
      <!-- Breadcrumb-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Panel</li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Lista de Estudiantes</a></li>
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
                            <strong>Formulario de Inscripción: <label class="text-info">{{ $entry->status }}</label> </strong>
                        </div>
                        <div class="col-sm-6" align="right">
                            @if($entry->status == 'Solicitado')
                              @php
                              $career = App\Models\Career::where('id', $entry->career_id)->with('students_with_space')->get();      
                              @endphp
                              @if ($career->available_space > $career->students_with_space->count())
                                <button class="btn btn-success btn-sm pl-3 pr-3 col-6" id="btnSign_up"><i class="nav-icon la la-check"></i>Alta Sistema de Cobranza</button>
                              @endif
                              <button class="btn btn-danger btn-sm pl-3 pr-3" id="btnCustomEmail"><i class="nav-icon la la-close"></i>Enviar Mensaje</button>

                            @elseif($entry->status == 'Aprobado')
                              <button class="btn btn-success btn-sm pl-3 pr-3 col-6" id="btnStatus"><i class="nav-icon la la-check"></i>Chequear estado de cuenta</button>
                            @endif
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
                        <label for="name">Correo</label>
                        <input class="form-control" type="text" value=" {{ $entry->user->email }} " disabled>
                      </div>
                    </div>
                    <div class="col-sm-12">
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
                        <input class="form-control" type="text" value=" {{ $entry->cycle_id }} " disabled>
                      </div>
                    </div>
                    <div class="col-sm-12">
                        <hr>
                    </div>
                    @php
                        $documentation[0] = $entry->documentation->where('description', 'Certificado de Estudios')->last();
                        $documentation[1] = $entry->documentation->where('description', 'Fotocopia de DNI')->last();
                        $documentation[2] = $entry->documentation->where('description', 'Foto Carnet')->last();
                    @endphp
                    <br><br><br><br>
  
                    @foreach ($documentation as $document)
                      @if ($document)
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
                      @endif
                    @endforeach
                    
                    <div class="col-sm-12">
                      <hr>
                    </div>
                    
                    <div class="col-12 col-lg-12 text-center">
                      <form action="{{url('/form_pdf')}}" method="post" target="_blank">
                          @csrf
                          <input type="hidden" id="id" name="id" value="{{$entry->user->id}}">
                          <button type="submit" class="btn btn-md text-white pl-5 pr-5" style="background: #881f1f"><i class="nav-icon la la-file-pdf-o"></i> <b class="h6">Descargar Formulario</b></button>
                      </form>
                      {{--<a href="form_pdf" target="_blank" class="btn btn-md login-submit-cs text-white" style="background: #881f1f">Formulario de Inscipción</a>--}}
                    </div>
                  </div>
                  <!-- /.row-->
                </div>
              </div>
            </div>
            @if($entry->status != 'Inscripto')
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                      <div class="row">
                          <div class="col-sm-12">
                              <strong>Historial de Mensajes:</strong>
                          </div>
                      </div>
                  </div>
                  <div class="card-body">

                    <table class="table table-responsive-sm table-sm table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Fecha y Hora</th>
                          <th>Mensaje</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($entry->message as $message)
                            <tr>
                              <td> {{ date("d/m/Y H:m:s", strtotime($message->created_at)) }} </td>
                              <td> {{ $message->text }} </td>
                            </tr>                 
                        @endforeach
                      </tbody>
                    </table>

                  </div>
                </div>
            </div>
            @endif
        </div>
      </div>
    </main>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>

    //alta sistema de cobranza
    var msg;
    var type;

    $( "#btnSignOn" ).click(function() {

      $(this).prop("disabled", true);
      $(this).html(
        '<i class="spinner-border spinner-border-sm"></i>'
      );

      $.post("sign_on")
      .done(function (result, status, xhr) {

        swal("Estudiante inscripto", "ISMP admin", {
          icon: type,
        }).then((value) => {;
          location.reload();
        })
        
      })
      .fail(function (xhr, status, error) {
        console.log("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText)
      });
    })


    $( "#btnStatus" ).click(function() {

      $(this).prop("disabled", true);
      $(this).html(
        '<i class="spinner-border spinner-border-sm"></i>'
      );

      $.post("check_status")
      .done(function (result, status, xhr) {

        //console.log(result['statusCode'])
        switch (result['statusCode']) {
          case 200:
            msg = result['msg'];
            type = "error"
            break;
          case 204:
            msg = result['msg'];
            type = "success"
            break;
          case 404:
            msg = result['msg'];
            type = "error"
            break;
          default:
            console.log(result)
            break;
        }

        swal(msg, "Sistema de Cobranza", {
          icon: type,
        }).then((value) => {;
          location.reload();
        })
      })
      .fail(function (xhr, status, error) {
        console.log("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText)
      });
    });


    $( "#btnSign_up" ).click(function() {

      
      $(this).prop("disabled", true);
      $(this).html(
        '<i class="spinner-border spinner-border-sm"></i>'
      );

      $.post("sign_up")
      .done(function (result, status, xhr) {
          switch (result) {
            case '400':
              msg = "El estudiante ya existe";
              type = "error"
              break;
            case '200':
              msg = "Estudiante dado de alta con éxito!";
              type = "success"
              break;
            default:
              console.log(result)
              break;
          }
        console.log(result)
          swal(msg, "Sistema de Cobranza", {
            icon: type,
          }).then((value) => {;
            location.reload();
          })
        
      })
      .fail(function (xhr, status, error) {
        console.log("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText)
      });
    });

    $( "#btnCustomEmail" ).click(async function() {
      const { value: text } = await Swal.fire({
        input: 'textarea',
        inputLabel: 'Mensaje para el Solicitante:',
        inputPlaceholder: 'Ej: la fotocopia del carnet es poco legible...',
        inputAttributes: {
          'aria-label': 'Type your message here'
        },
        showCancelButton: true
      })

      if (text) {
        $.post("custom_email",{
          val: text
        })
        .done(function (result, status, xhr) {
          console.log(result)
          swal("Mensaje enviado!", "Formulario pendiente de modificación", {
            icon: "success",
          }).then((value) => {;
            location.reload();
          })
        })
        .fail(function (xhr, status, error) {
          console.log("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText)
        });
      }
    });

  </script>

@endsection