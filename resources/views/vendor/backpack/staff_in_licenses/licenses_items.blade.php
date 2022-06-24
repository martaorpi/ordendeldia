<div class="col-12">
    <h5 class="mt-4">Personas</h5>&nbsp;&nbsp;
    <table class="table responsive">
        <thead>
            <tr>
                <th>Personal</th>
                <th>Días Solicitados</th>
                <th>Fecha Solicitud</th>
                <th>Fecha Autorizada</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Estado</th>
                <th>Observaciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($staff as $s)
                <tr>
                    <td>{{ $s->staff->name }}</td>
                    <td>{{ $s->requested_days }}</td>
                    <td>{{ $s->application_date }}</td>
                    <td>{{ $s->authorized_date }}</td>
                    <td>{{ $s->start_date }}</td>
                    <td>{{ $s->end_date }}</td>
                    <td>{{ $s->status }}</td>
                    <td>{{ $s->observations }}</td>
                    <td>
                        {{--<button class="btn mb-1" type="button" onclick="visualizardomicilio('{{$license->license_id}}', '{{$license->requested_days}}', '{{$license->application_date}}','{{$license->authorized_date}}', '{{$license->start_date}}','{{$license->end_date}}')"><i class="la la-eye la-lg text-info"></i></button>--}}
                        <button class="btn mb-1" type="button" onclick="deleteStaff({{$s->id}})"><i class="la la-trash la-lg text-danger"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    function deleteStaff(id){
        swal("Esta seguro que desea eliminar este elemento?", {
            buttons: {
                cancel: "Cancelar",
                catch: {
                    text: "Si, Eliminar",
                    value: "catch",
                },
            },
        })
        .then((value) => {
            switch (value) {
                case "catch":
                    $.post('delete_staff', {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    }).done(function(data){
                        swal("Eliminado con Exito", {
                            icon: "success",
                        }).then((value) => {;
                            $('#response_staff').html(data)
                        })
                    }).fail(function(data){
                        console.log(data)
                    })
                break;
            }
            
        });             
    }
    
</script>
  
  
