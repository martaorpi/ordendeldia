@php                      
$careers = App\Models\Career::get();
@endphp
<div role="tablist">
  <div class="row">
    <div class="col-12">
      <div class="form-group mx-3">
        <label for="name">Carrera<label class="text-danger">*</label></label>    
        <select name="" id="career" class="form-control">
          <option value="">Seleccione la carrera</option>
          @foreach ($careers as $career)
            <option value="{{$career->id}}">{{ $career->short_name}}</option>    
          @endforeach
        </select>
      </div>
    </div>


    <div class="col-12">
      <div class="form-group mx-3">
        <label for="course" class="form-label">Asignatura</label>
        <select class="form-control" name="subject_id" id="subject"></select>
      </div>
    </div>


    <div class="col-lg-6 col-12">
      @include('crud::fields.'.$fields['subject_id']['type'], ['field' => $fields['subject_id']])          
    </div>
    <div class="col-lg-6 col-12">
      @include('crud::fields.'.$fields['correlative_id']['type'], ['field' => $fields['correlative_id']])
    </div> 
  </div>
  <div class="row">
    <div class="col-lg-6 col-12">
      @include('crud::fields.'.$fields['condition']['type'], ['field' => $fields['condition']])          
    </div>
    <div class="col-lg-6 col-12">
      @include('crud::fields.'.$fields['correlativity_type']['type'], ['field' => $fields['correlativity_type']])
    </div> 
  </div>    
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {
    $('#career').on('change', function() {
      var careerID = $(this).val();
      if(careerID) {
          $.ajax({
              url: '/getSubjects/'+careerID,
              type: "GET",
              data : {"_token":"{{ csrf_token() }}"},
              dataType: "json",
              success:function(data)
              {
                /*if(data){
                    $('#subject').empty();
                    $('#subject').append('<option hidden>Choose Course</option>'); 
                    $.each(data, function(key, subject){
                        $('select[name="subject_id"]').append('<option value="'+ key +'">' + subject.description+ '</option>');
                    });
                }else{
                    $('#subject').empty();
                }*/
                alert()
            }
          });
      }else{
        $('#subject').empty();
      }
    });
  });
</script>