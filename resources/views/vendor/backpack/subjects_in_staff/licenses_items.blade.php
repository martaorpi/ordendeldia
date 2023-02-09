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
            @foreach ($licenses as $license)
                <tr>
                    <td>{{ $license->license->article }}</td>
                    <td>{{ $license->requested_days }}</td>
                    <td>{{ $license->application_date }}</td>
                    <td>{{ $license->authorized_date }}</td>
                    <td>{{ $license->start_date }}</td>
                    <td>{{ $license->end_date }}</td>
                    <td>{{ $license->status }}</td>
                    <td>{{ $license->observations }}</td>
                    <td>
                        {{--<button class="btn mb-1" type="button" onclick="visualizardomicilio('{{$license->license_id}}', '{{$license->requested_days}}', '{{$license->application_date}}','{{$license->authorized_date}}', '{{$license->start_date}}','{{$license->end_date}}')"><i class="la la-eye la-lg text-info"></i></button>--}}
                        <button class="btn mb-1" type="button" onclick="deleteLicense({{$license->id}})"><i class="la la-trash la-lg text-danger"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    function deleteLicense(id){
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
                    $.post('delete_licenses', {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    }).done(function(data){
                        swal("Eliminado con Exito", {
                            icon: "success",
                        }).then((value) => {;
                            $('#response_licenses').html(data)
                        })
                    }).fail(function(data){
                        console.log(data)
                    })
                break;
            }
            
        });             
    }
    
    /*function visualizardomicilio(tipo, direccion, barrio, provincia, departamento,  localidad) {
        const wrapperD = document.createElement('div');      
        wrapperD.innerHTML =    '<hr><div class="row pl-5 pr-5 pb-5" align="left">'+
            '<div class="col-6"><b>Tipo:</b></div>'+
            '<div class="col-6">'+tipo+'</div>'+
            '<div class="col-6"><b>Domicilio:</b></div>'+
            '<div class="col-6">'+direccion+'</div>'+
            '<div class="col-6"><b>Barrio:</b></div>'+
            '<div class="col-6">'+barrio+'</div>'+
            '<div class="col-6"><b>Localidad:</b></div>'+
            '<div class="col-6">'+localidad+'</div>'+
            '<div class="col-6"><b>Departamento:</b></div>'+
            '<div class="col-6">'+departamento+'</div>'+
            '<div class="col-6"><b>Provincia:</b></div>'+
            '<div class="col-6">'+provincia+'</div>'+
        '</div>';
        swal({
            title: "Domicilio",
            button: false,
            content: wrapperD,
        }).then((value) => {
        
      });
    }*/
</script>
  
  
