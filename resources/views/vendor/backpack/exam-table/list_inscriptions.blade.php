@extends(backpack_view('blank'))
<div class="col-12">
  <h5 class="mt-4">Items</h5>&nbsp;&nbsp;
  <table class="table responsive">
      <thead>
          <tr>
              <th>Asignatura</th>
              <th>Comisión</th>
              <th>Estado</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($inscriptions as $item)
              <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                      <button class="btn mb-1" type="button" onclick="deleteSubject({{$item->id}})"><i class="la la-trash la-lg text-danger"></i></button>
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
                  $.post('delete_subject', {
                      "_token": "{{ csrf_token() }}",
                      "id": id
                  }).done(function(data){
                      swal("Eliminado con Exito", {
                          icon: "success",
                      }).then((value) => {;
                          $('#response_items').html(data)
                      })
                  }).fail(function(data){
                      console.log(data)
                  })
              break;
          }
          
      });             
  }
  
</script>


