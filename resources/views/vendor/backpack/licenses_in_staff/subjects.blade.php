<div class="col-lg-12">    
  <button class="btn mb-1 btn-info btn-sm" type="button" onclick="additemSubject({{ $staff_id }})"><i class="la la-plus"></i>&nbsp;Añadir Asignatura</button>          
</div>

<div class="col-12" id="response_subjects">
  @if (count($subjects_staff) > 0)
    @include('vendor.backpack.licenses_in_staff.subjects_items', ['subjects_staff' => $subjects_staff])
  @endif
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  const wrapper3 = document.createElement('div');      
  let subjectId = 0;
  let careerId = 0;

  function additemSubject() {
    swal({
      title: "Asignatura",
      buttons: ["Cancelar", "Añadir"],
      content: wrapper3,     
    }).then((value) => {
      if (value) {
        $.post('subjects', {
            "subject_id": subjectId,
            "job_id": $('#job').val(),
            "plant_mode": $('#plant_mode').val(),
            "plant_type": $('#plant_type').val(),
            "weekly_hours": $('#weekly_hours').val(),
            "start_date": $('#start_date').val(),
            "end_date": $('#end_date').val(),
            "resolution_number": $('#resolution_number').val(),
        }).done(function(data){
          swal("Agregado con exito", {
            icon: "success",
          }).then((value) => {;
            $('#response_subjects').html(data)
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

  const getSubjects = async () =>{
    try {
      const url = "get_subjects/1";
      const response = await fetch (url);
      const result = await response.json();

      return result
    }catch ( error ){
      console.log( error );
    }
  }

  getSubjects().then( data => {
      let optionsHTML = ""
      data.map(element => {
        optionsHTML += '<option value="'+element.id+'">'+element.description+'</option>'
      });

      wrapper3.innerHTML =
        `<div class="row" align="left">

          <div class="col-6">
            <div class="form-group">
              <label for="name">Carrera <label class="text-danger">*</label></label>
              <select class="form-control form-select" onchange="selectCareer()" id="career">
                <option value="">Seleccione</option>
                <option value="1">Trabajo Social</option>
                <option value="2">Hemoterapia</option>
                <option value="3">Laboratorio</option>
                <option value="4">Instrumentación Quirúrgica</option>
                <option value="5">Radiología</option>
              </select>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="name">Asignatura <label class="text-danger">*</label></label>
              <select class="form-control form-select" onchange="selectSubject()" id="articulo">
                '<option value="">Seleccione</option>'
                ${optionsHTML}
              </select>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="name">Función <label class="text-danger">*</label></label>
              <select class="form-control form-select" id="job">
                <option value="">Seleccione</option>
                <option value="6">Hs. Cátedra Nivel Sup</option>
                <option value="11">Ayudante Trab. Pract.</option>
              </select>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="name">Modo de planta <label class="text-danger">*</label></label>
              <select class="form-control form-select" id="plant_mode">
                <option value="">Seleccione</option>
                <option value="1er Cuatrimestre">1er Cuatrimestre</option>
                <option value="2do Cuatrimestre">2do Cuatrimestre</option>
                <option value="Anual">Anual</option>
              </select>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="name">Modo de planta <label class="text-danger">*</label></label>
              <select class="form-control form-select" id="plant_type">
                <option value="">Seleccione</option>
                <option value="TITULAR SPEP">TITULAR SPEP</option>
                <option value="SUPLENTE SPEP">SUPLENTE SPEP</option>              
              </select>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="name">Horas semanales <label class="text-danger">*</label></label>
              <input class="form-control" type="number" id="weekly_hours"></input>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="name">Fecha de Inicio <label class="text-danger">*</label></label>
              <input class="form-control" type="date" id="start_date"></input>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="name">Fecha de Baja </label>
              <input class="form-control" type="date" id="end_date"></input>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="name">Resolución Nro <label class="text-danger">*</label></label>
              <input class="form-control" type="text" id="resolution_number"></input>
            </div>
          </div>

        </div>`;
    });

    function selectSubject(){
      subjectId = document.getElementById("articulo").value;
      console.log(subjectId)
      return $(subjectId);
    }

    function selectCareer(){
      careerId = document.getElementById("career").value;
      console.log(careerId)
      return $(careerId);
    }
    
</script>
  
  
