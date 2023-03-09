@php
$doc = App\Models\Doc::orderBy('updated_at', 'desc')->first();
//echo 'uploads/bol-2020-12-30-firmado.pdf';//$doc->src;
use Illuminate\Support\Facades\Auth;
echo auth->user()->id;
@endphp

<style>
  .app-footer{
    background-color: #28166F !important;
    color:#fff !important;
  }
  .app-footer a, .app-header a{
    color:#fff !important;
  }
  .app-header{
    background-color: #28166F !important;
    color:#fff !important;
  }
</style>
<div class="card">
  <div class="card-body" style="height:80vh">
    <h3>Boletín Policial - Orden del día</h3>
    @if($doc)
      <iframe width="100%" style="height:70vh" src="{{asset($doc->src)}}" frameborder="0"></iframe>
    @else
      <h4 class="mt-5">No hay documentos cargados</h4>
    @endif
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
