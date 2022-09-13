{{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}

<div class="col-lg-12">    
  <button class="btn mb-1 btn-info btn-sm" type="button" onclick="additemDiscount({{ $staff_id}})"><i class="la la-plus"></i>&nbsp;Añadir Descuento</button>          
</div>

<div class="col-12" id="response_discounts">
  @if (count($discounts) > 0)
    @include('vendor.backpack.licenses_in_staff.discounts_items', ['discounts' => $discounts])
  @endif
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  const wrapper2 = document.createElement('div');      
  let discountId = 1;

  function additemDiscount() {
    swal({
      title: "Descuento",
      buttons: ["Cancelar", "Añadir"],
      content: wrapper2,     
    }).then((value) => {
      if (value) {
        $.post('discounts', {
            "discount_id": discountId,
            "amount": $('#monto').val(),
            "days": $('#dias').val(),
            "percentage": $('#porcentaje').val(),
            "file_number": $('#nro_expte').val(),
            "date_notification": $('#fecha_notif').val(),
            "observations": $('#obs').val(),
        }).done(function(data){
          swal("Agregado con exito", {
            icon: "success",
          }).then((value) => {;

            $('#response_discounts').html(data)
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
    const getDiscounts = async () =>{
      try {
        const url = "get_discounts";
        const response = await fetch (url);
        const result = await response.json();

        return result
      }catch ( error ){
        console.log( error );
        return categories;
      }
    }

    getDiscounts().then( data => {
      let optionsHTML = ""
      data.map(element => {
        optionsHTML += '<option value="'+element.id+'">'+element.description+'</option>'
      });

      wrapper2.innerHTML =
        `<div class="row" align="left">

          <div class="col-6">
            <div class="form-group">
              <label for="name">Descuento <label class="text-danger">*</label></label>
              <select class="form-control form-select" onchange="selectDisc()" id="discount">
                '<option value="">Seleccione</option>'
                ${optionsHTML}
              </select>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="name">Monto</label>
              <input class="form-control" type="number" id="monto" step="0.01" pattern="^\d+(?:\.\d{1,2})?$"></input>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="name">Días</label>
              <input class="form-control" type="number" id="dias"></input>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="name">Porcentaje</label>
              <input class="form-control" type="number" id="porcentaje" step="0.01" pattern="^\d+(?:\.\d{1,2})?$"></input>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="name">Nro Expediente</label>
              <input class="form-control" type="text" id="nro_expte"></input>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="name">Fecha de Notificación</label>
              <input class="form-control" type="date" id="fecha_notif"></input>
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
    
    function selectDisc(){
      discountId = document.getElementById("discount").value;
      return $(discountId);
    }

</script>
  
  
