<div class="col-12">
    <h5 class="mt-4">Licencias</h5>&nbsp;&nbsp;
    <table class="table responsive">
        <thead>
            <tr>
                <th>Artículo</th>
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
            @foreach ($subjects as $subject)
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        {{--<button class="btn mb-1" type="button" onclick="visualizardomicilio('{{$license->license_id}}', '{{$license->requested_days}}', '{{$license->application_date}}','{{$license->authorized_date}}', '{{$license->start_date}}','{{$license->end_date}}')"><i class="la la-eye la-lg text-info"></i></button>--}}
                        <button class="btn mb-1" type="button" onclick="deleteSubject({{$subject->id}})"><i class="la la-trash la-lg text-danger"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    function deleteSubject(id){
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
                    $.post('delete_subjects', {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    }).done(function(data){
                        swal("Eliminado con Exito", {
                            icon: "success",
                        }).then((value) => {;
                            $('#response_subjects').html(data)
                        })
                    }).fail(function(data){
                        console.log(data)
                    })
                break;
            }       
        });             
    }
</script>
  
  
