@extends(backpack_view('blank'))

<style>
.card-counter{
    box-shadow: 2px 2px 10px #DADADA;
    margin: 5px;
    padding: 20px 10px;
    background-color: #fff;
    height: 120px;
    border-radius: 5px;
    transition: .3s linear all;
  }
  .card-counter:hover{
    box-shadow: 4px 4px 20px #DADADA;
    transition: .3s linear all;
  }
  .card-counter.primary{
    background-color: #ba0101;
    color: #FFF;
  }
  .card-counter i{
    font-size: 5em;
    opacity: 0.2;
  }
  .card-counter .count-numbers2{
    position: absolute;
    right: 35px;
    top: 20px;
    font-size: 18px;
    display: block;
  }
  .card-counter .count-numbers{
    position: absolute;
    left: 35px;
    top: 15px;
    font-size: 32px;
    display: block;
  }
  .card-counter .count-numbers small{
    font-size: 20px !important;
  }
  .card-counter .count-name{
    position: absolute;
    right: 35px;
    top: 85px;
    font-style: italic;
    text-transform: capitalize;
    opacity: 0.6;
    display: block;
    font-size: 23px;
  }
</style>

@section('content')

<div class="container">
    <div class="row">
      <form method="post" action="{{ url('formulario-inscripcion') }}" class="" enctype="multipart/form-data">
          <div class="form-group row">
              <div class="col-12">
                  <b>Adjunte el archivo PDF del Orden del Día:</b>
              </div>
          </div>

          <div class="form-group row">
              <div class="col-12">
                  <input type="file" class="form-control-file" name="files[]" multiple >
                  <input type="hidden" value="Certificado de Estudios" name="description0">
              </div>
          </div>

          <div class="form-group row">
              <div class="col-12">
                  <hr class="linea_bordo">
              </div>
          </div>
          <button type="submit" class="btn btn_bordo text-white btn-block" disabled="true" id="btn-actualizar">Enviar</button>

      </form>
    </div>
</div>

@endsection