{{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}

<div class="col-lg-12">    
  <button class="btn mb-1 btn-info btn-sm" type="button" onclick="additemLicense({{ $staff_id}})"><i class="la la-plus"></i>&nbsp;Añadir Licencia</button>          
</div>

<div class="col-12" id="response_licenses">
  @if (count($licenses) > 0)
    @include('vendor.backpack.licenses_in_staff.licenses_items', ['licenses' => $licenses])
  @endif
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    /*function additemLicense() {
      const wrapper = document.createElement('div');      

      wrapper.innerHTML = '<hr>'+ 
                        '<div class="row" align="left">'+
                            '<div class="col-12">'+
                                '<div class="form-group">'+
                                '<label for="name">Articulo <label class="text-danger">*</label></label>'+
                                licenseSelectHTML('tipo', ['Legal','Transitorio'])+
                                '<input class="form-control" type="number" id="licencse"></input>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-12">'+
                                '<div class="form-group">'+
                                '<label for="name">Domicilio<label class="text-danger">*</label></label>'+
                                '<textarea class="form-control" type="text" id="direccion" rows="5" minlength="4"></textarea>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-12">'+
                                '<div class="form-group">'+
                                '<label for="name">Barrio<label class="text-danger">*</label></label>'+
                                '<input class="form-control" type="text" id="barrio" minlength="4"></input>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-12">'+
                                '<div class="form-group">'+
                                '<label for="name">Provincia<label class="text-danger">*</label></label>'+
                                domicilioSelectHTML('provincia', ['Santiago del Estero','Buenos Aires','Catamarca','Chaco','Chubut','Cordoba','Corrientes','Entre Ríos','Formosa','Jujuy','La Pampa','La Rioja','La Rioja','Misiones','Neuquén','Río Negro','Salta','San Juan','San Luis','Santa Cruz','Santa Fe','Tierra del Fuego','Tucumán','CABA'])+
                                '</div>'+
                            '</div>'+
                            '<div class="col-12">'+
                                '<div class="form-group">'+
                                '<label for="name">Departamento<label class="text-danger">*</label></label>'+
                                domicilioSelectHTML('departamento', ['Aguirre','Alberdi','Atamisqui','Avellaneda','Banda','Belgrano','Capital','Choya','Copo','Figueroa','Gral. Taboada','Guasayán','Jiménez','J. F. Ibarra','Loreto','Mitre','Moreno','Ojo de Agua','Pellegrini','Quebrachos','Río Hondo','Rivadavia','Robles','Salavina','San Martin','Sarmiento','Silípica','Otro'])+
                                '</div>'+
                            '</div>'+
                            '<div class="col-12">'+
                                '<div class="form-group">'+
                                '<label for="name">Localidad<label class="text-danger">*</label></label>'+
                                '<input class="form-control" type="text" id="localidad" minlength="4"></input>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
      
      swal({
        title: "Licencia",
        buttons: true,
        buttons: ["Cancelar", "Añadir"],
        content: wrapper,     
      }).then((value) => {
        if (value) {
          $.post('licenses', {
              "license_id": $('#license').val(),
              "direccion": $('#direccion').val(),
              "barrio": $('#barrio').val(),
              "provincia": $('#provincia').val(),
              "departamento": $('#departamento').val(),
              "localidad": $('#localidad').val(),
          }).done(function(data){
            swal("Agregado con exito", {
              icon: "success",
            }).then((value) => {;

              $('#response_licenses').html(data)
            })
          }).fail(function(error){
            swal("Completar todos los campos obligatorios", {
              icon: "error",
            }).then((value) => {;
              $('#response_antecedentes_familiares').html(data)
            })
              console.log(error)
          })
        }            
      });
    }*/

    /*function domicilioSelectHTML(id ,array){
      _options = ""
      array.forEach(element => {
        _options += '<option value="'+element+'">'+element+'</option>'
      });

      return '<select class="form-control" id="'+id+'">'+_options+'</select>'
    }*/


  const wrapper = document.createElement('div');      
  let idArticle = 1;
  function additemLicense() {
    swal({
      title: "Licencia",
      buttons: ["Cancelar", "Añadir"],
      content: wrapper,     
    }).then((value) => {
      if (value) {
        $.post('licenses', {
            "license_id": idArticle,
            "requested_days": $('#dias_solicitados').val(),
            "application_date": $('#fecha_solicitud').val(),
            "authorized_date": $('#fecha_autorizacion').val(),
            "start_date": $('#fecha_inicio').val(),
            "end_date": $('#fecha_fin').val(),
            "status": "En curso",
            "observations": $('#obs').val(),
        }).done(function(data){
          swal("Agregado con exito", {
            icon: "success",
          }).then((value) => {;

            $('#response_licenses').html(data)
          })
        }).fail(function(error){
          swal("Completar todos los campos obligatorios", {
            icon: "error",
          }).then((value) => {;
            
          })
          console.log(error)
        })
      }      
    })
  }
    const getLicenses = async () =>{
      try {
        const url = "get_licenses";
        const response = await fetch (url);
        const result = await response.json();

        return result
      }catch ( error ){
        console.log( error );
        return categories;
      }
    }

    getLicenses().then( data => {
      let optionsHTML = ""
      data.map(element => {
        optionsHTML += '<option value="'+element.id+'">'+element.article+'</option>'
      });

      wrapper.innerHTML =
        `<div class="row" align="left">

          <div class="col-6">
            <div class="form-group">
              <label for="name">Artículo <label class="text-danger">*</label></label>
              <select class="form-control form-select" id="getIdArticle(this)">
                ${optionsHTML}
              </select>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="name">Días Solicitados <label class="text-danger">*</label></label>
              <input class="form-control" type="number" id="dias_solicitados"></input>
            </div>
          </div>
          
          <div class="col-6">
            <div class="form-group">
              <label for="name">Fecha de Solicitud <label class="text-danger">*</label></label>
              <input class="form-control" type="date" id="fecha_solicitud"></input>
            </div>
          </div>
          
          <div class="col-6">
            <div class="form-group">
              <label for="name">Fecha de Autorización <label class="text-danger">*</label></label>
              <input class="form-control" type="date" id="fecha_autorizacion"></input>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="name">Fecha Inicio <label class="text-danger">*</label></label>
              <input class="form-control" type="date" id="fecha_inicio"></input>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="name">Fecha Fin <label class="text-danger">*</label></label>
              <input class="form-control" type="date" id="fecha_fin"></input>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
              <label for="name">Observaciones <label class="text-danger">*</label></label>
              <textarea class="form-control" id="obs"></textarea>
            </div>
          </div>

        </div>`;
    });

    function getIdArticle(e){
      idArticle = e.value
    }

</script>
  
  
