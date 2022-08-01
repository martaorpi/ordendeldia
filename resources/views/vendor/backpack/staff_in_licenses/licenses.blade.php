{{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}

<div class="col-lg-12">    
  <button class="btn mb-1 btn-info btn-sm" type="button" onclick="additemStaff({{ $license_id}})"><i class="la la-plus"></i>&nbsp;Añadir Persona</button>          
</div>

<div class="col-12" id="response_staff">
  @if (count($staff) > 0)
    @include('vendor.backpack.staff_in_licenses.licenses_items', ['staff' => $staff])
  @endif
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    
  const wrapper = document.createElement('div');  
  let staffId = 0;

  function additemStaff() {
    swal({
      title: "Datos de la Licencia",
      buttons: ["Cancelar", "Añadir"],
      content: wrapper,     
    }).then((value) => {
      if (value) {
        $.post('staff-licenses', {
            "staff_id": staffId,
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

            $('#response_staff').html(data)
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
    const getStaff = async () =>{
      try {
        const url = "get_staff";
        const response = await fetch (url);
        const result = await response.json();

        return result
      }catch ( error ){
        console.log( error );
        return categories;
      }
    }

    getStaff().then( data => {
      let optionsHTML = ""
      data.map(element => {
        optionsHTML += '<option value="'+element.id+'">'+element.name+'</option>'
      });

      wrapper.innerHTML =
        `<div class="row" align="left">

          <div class="col-12">
            <div class="form-group">
              <label for="name">Personal <label class="text-danger">*</label></label>
              <select class="form-control form-select" onchange="selectStaff()" id="staff">
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
    
    function selectStaff(){
      staffId = document.getElementById("staff").value;
      console.log(staffId)
      return $(staffId);
    }

</script>
  
  
