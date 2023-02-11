<div class="col-12">
    <h5 class="mt-4">Asignaturas</h5>&nbsp;&nbsp;
    <table class="table responsive">
        <thead>
            <tr>
                <th>Carrera</th>
                <th>Asignatura</th>
                <th>Función</th>
                <th>Período</th>
                <th>Planta</th>
                <th>Hs Semanales</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Nro Resol.</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects_staff as $subject_staff)
                @if ($subject_staff->job_id == 6 || $subject_staff->job_id == 11)
                    <tr>
                        <td>{{ $subject_staff->subject->career->short_name }}</td>
                        <td>{{ $subject_staff->subject->description }}</td>
                        <td>{{ $subject_staff->job->description }}</td>
                        <td>{{ $subject_staff->plant_mode }}</td>
                        <td>{{ $subject_staff->plant_type }}</td>
                        <td>{{ $subject_staff->weekly_hours }}</td>
                        <td>{{ $subject_staff->start_date }}</td>
                        <td>{{ $subject_staff->end_date }}</td>
                        <td>{{ $subject_staff->resolution_number }}</td>
                        <td>
                            {{--<button class="btn mb-1" type="button" onclick="visualizardomicilio('{{$license->license_id}}', '{{$license->requested_days}}', '{{$license->application_date}}','{{$license->authorized_date}}', '{{$license->start_date}}','{{$license->end_date}}')"><i class="la la-eye la-lg text-info"></i></button>--}}
                            <button class="btn mb-1" type="button" onclick="deleteSubject({{$subject_staff->id}})"><i class="la la-trash la-lg text-danger"></i></button>
                        </td>
                    </tr>
                @endif
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
  
  
