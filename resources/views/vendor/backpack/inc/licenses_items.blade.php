<div class="col-12">
    <div class="row">
        @foreach ($licenses as $license)
        <div class="col-lg-6 col-md-6 col-12">
            <div class="brand-card">
                <div class="col-12 pt-2" align="right">
                    {{--<button class="btn mb-1" type="button" onclick="visualizardomicilio('{{$domicilio->tipo}}', '{{$domicilio->direccion}}', '{{$domicilio->barrio}}','{{$domicilio->provincia}}', '{{$domicilio->departamento}}','{{$domicilio->localidad}}')"><i class="la la-eye la-lg text-info"></i></button>
                    <button class="btn mb-1" type="button" onclick="eliminardomicilio({{$domicilio->id}})"><i class="la la-trash la-lg text-danger"></i></button>--}}//
                </div>            
                <div class="brand-card-body">
                    {{--<div>
                        <div class="">

                            <b> {{$domicilio->tipo}} </b>
                            
                        </div>
                        <div class="text-uppercase text-muted small">Tipo</div>
                    </div>
                    <div>
                        <div class="">

                            <b> {{$domicilio->direccion}}, Bº {{$domicilio->barrio}} </b>
                            
                        </div>
                        <div class="text-uppercase text-muted small">Domicilio</div>
                    </div>--}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<script>
    /*function eliminardomicilio(id){
        
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
                    $.post('delete_domicilios', {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    }).done(function(data){
                        swal("Eliminado con Exito", {
                            icon: "success",
                        }).then((value) => {;
                            $('#response_domicilios').html(data)
                        })
                    }).fail(function(data){
                        console.log(data)
                    })
                break;
            }
            
        });             
    }
    
    function visualizardomicilio(tipo, direccion, barrio, provincia, departamento,  localidad) {
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
  
  
