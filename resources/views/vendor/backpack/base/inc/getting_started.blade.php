<style>
  /*.brand-card-header {
    height: 30px;
  }

  .a-brand-card-body {
    color: #233255;
  }

  .a-brand-card-body:hover {
    color: #1d2945;
  }

  .a-brand-card-body:hover {
    color: #1d2945;
    text-decoration: none;
  }

  .a-brand-card-body:hover h4{
    text-decoration: underline;
  }*/

  .card {
    font-weight: 400;
    border: 0;
    -webkit-box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
    box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: 0.25rem;
    flex: 1 0 0%;
    margin-right: 15px;
    margin-bottom: 15px;
    margin-left: 15px;
  }

  a {
    text-decoration: none !important;
  }

  .view {
    position: relative;
    overflow: hidden;
    cursor: pointer;
  }

  .shadow {
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
  }

  .rounded-top {
    border-top-left-radius: 0.25rem!important;
    border-top-right-radius: 0.25rem!important;
  }

  img {
    max-width: 100%;
    height: auto;
    border-style: none;
  }

  .card-img-top {
    flex-shrink: 0;
    width: 100%;
    border-top-left-radius: calc(0.25rem - 1px);
    border-top-right-radius: calc(0.25rem - 1px);
  }

  .view img {
    position: relative;
    display: block;
    height: 180px;
    object-fit: cover;
  }

  .rgba-blue-slight, .rgba-blue-slight:after {
    background-color: rgba(33,150,243,0.1);
  }

  .view .mask {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    background-attachment: fixed;
  }

  .inicio_card_title {
    height: 80px;
  }

  .aquamarine-gradient {
      background: linear-gradient(40deg, #3ed0d0, #145661);
  }

  .zoom {
    height: 180px;
    overflow: hidden;
  }

  .zoom img {
    transition: transform .5s ease;
  }
  .zoom:hover img {
    transform: scale(1.1);
  }

</style>

@php
$mes_ant = date('Y-m-d' ,strtotime('-1 months', strtotime(date('Y-m-d'))));
@endphp

<div class="card">
  <div class="card-body">

    <h3>Boletín Policial - Orden del día</h3>
    <h4>Relaciones Públicas Policiales</h4><br>

    <div class="row">
      <div class="col-12">
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
              <button type="submit" class="btn btn-primary text-white btn-block" disabled="true" id="btn-actualizar">Enviar</button>

          </form>
      </div>
    </div>

  </div>
</div>

@push('after_styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/styles/base16/dracula.min.css">
@endpush

@push('after_scripts')
  <script src="https://use.fontawesome.com/4fde5ebf74.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/highlight.min.js"></script>
  <script>hljs.highlightAll();</script>
@endpush
