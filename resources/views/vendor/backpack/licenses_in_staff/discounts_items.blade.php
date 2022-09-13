<div class="col-12">
    <h5 class="mt-4">Licencias</h5>&nbsp;&nbsp;
    <table class="table responsive">
        <thead>
            <tr>
                <th>Descuento</th>
                <th>Monto</th>
                <th>Días</th>
                <th>Porcentaje</th>
                <th>Nro Expediente</th>
                <th>Fecha Notificación</th>
                <th>Observaciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($discounts as $discount)
                <tr>
                    <td>{{ $discount->discount->description }}</td>
                    <td>{{ $discount->amount }}</td>
                    <td>{{ $discount->days }}</td>
                    <td>{{ $discount->percentage }}</td>
                    <td>{{ $discount->file_number }}</td>
                    <td>{{ $discount->date_notification }}</td>
                    <td>{{ $discount->observations }}</td>
                    <td>
                        {{--<button class="btn mb-1" type="button" onclick="visualizardomicilio('{{$license->license_id}}', '{{$license->requested_days}}', '{{$license->application_date}}','{{$license->authorized_date}}', '{{$license->start_date}}','{{$license->end_date}}')"><i class="la la-eye la-lg text-info"></i></button>--}}
                        <button class="btn mb-1" type="button" onclick="deleteDiscount({{$discount->id}})"><i class="la la-trash la-lg text-danger"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    function deleteDiscount(id){
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
                    $.post('delete_discounts', {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    }).done(function(data){
                        swal("Eliminado con Exito", {
                            icon: "success",
                        }).then((value) => {;
                            $('#response_discounts').html(data)
                        })
                    }).fail(function(data){
                        console.log(data)
                    })
                break;
            }
            
        });             
    }
    
</script>
  
  
