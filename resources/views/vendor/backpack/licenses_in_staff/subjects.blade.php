{{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}

<div class="col-lg-12">    
  <button class="btn mb-1 btn-info btn-sm" type="button" onclick="additemSubject()"><i class="la la-plus"></i>&nbsp;Añadir Asignatura</button>          
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    
  

  function additemSubject() {

    swal({
      title: "Asignatura",
      buttons: ["Cancelar", "Añadir"],
      content: wrapper,     
    }).then((value) => {
      if (value) {
        $.post('subjects', {}).done(function(data){
          swal("Agregado con exito", {
            icon: "success",
          }).then((value) => {;

            //$('#response_licenses').html(data)
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
    
</script>
  
  
