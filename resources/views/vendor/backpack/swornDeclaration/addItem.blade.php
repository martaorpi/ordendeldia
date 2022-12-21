<div class="col-12">
  <button class="btn mb-1 btn-info btn-sm" type="button" onclick="addItem({{ $sworn_declaration_id }})"><i class="la la-plus"></i>&nbsp;Añadir Asignatura</button>
</div>

<div class="col-12" id="response_items">
  @if (count($swornDeclarationItems) > 0)
    @include('vendor.backpack.swornDeclaration.list_items', ['swornDeclarationItems' => $swornDeclarationItems])
  @endif
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  const wrapper = document.createElement('div');
  let subjectId = 0;

  function addItem() {
    swal({
      title: "Asignatura",
      buttons: ["Cancelar", "Añadir"],
      content: wrapper,     
    }).then((value) => {
      if (value) {
        $.post('sworn-declaration-item', {
          "subject_id": subjectId, 
          "commission": $('#comision').val(),
          //"condition": $('#condicion').val(),
          "status": $('#estado').val(),
        }).done(function(data){
          swal("Agregado con exito", {
            icon: "success",
          }).then((value) => {;
            $('#response_items').html(data)
          })
        }).fail(function(error){
          swal("Completar todos los campos obligatorios", {
            icon: "error",
          }).then((value) => {;
            //$('#response_antecedentes_familiares').html(data)
          })
            console.log(error)
        })
      }          
    })
  }
    const getSubjects = async () =>{
      try {
        const url = "get_subjects";
        const response = await fetch (url);
        const result = await response.json();

        return result
      }catch ( error ){
        console.log( error );
        //return categories;
      }
    }

    /*getSubjects().then( data => {
      let optionsHTML = ""
      data.map(element => {
        optionsHTML += '<option value="'+element.id+'">'+element.description+'</option>'
      });*/
      wrapper.innerHTML =
        `<div class="row" align="left">
          <div class="col-12">
            <div class="form-group">
              <label for="name">Asignatura <label class="text-danger">*</label></label>
              <select class="form-control form-select" onchange="selectSubject()" id="subject">
                <option value="">Seleccione la Asignatura</option>
                ${optionsHTML}
              </select>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="name">Comisión </label>
              <input class="form-control" type="number" id="comision"></input>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="name">Estado </label>
              <select class="form-control form-select" id="estado">
                <option value="Estado1">Estado1</option>
                <option value="Estado2">Estado2</option>
              </select>
            </div>
          </div>

        </div>`;
    //});

    function selectSubject(){
      subjectId = document.getElementById("subject").value;
      console.log(subjectId)
      return $(subjectId);
    }

</script>