@extends(backpack_view('blank'))

@php
    $doc = App\Models\Doc::where('id', $entry->getKey())->first();
    switch ($doc->type) {
        case 'Completo': $title = 'Boletín Policial'; break;
        case 'Estructura Organizacional': $title = 'Estructura Organizacional'; break;
        case 'Recursos Humanos': $title = 'Recursos Humanos'; break;
        case 'Disposiciones Generales': $title = 'Disposiciones Generales'; break;
        case 'Desarrollo Educativo': $title = 'Desarrollo Educativo'; break;
        case 'Disposiciones Judiciales': $title = 'Disposiciones Judiciales'; break;
        case 'Urgentes': $title = 'Disposiciones Judiciales Urgentes'; break;
    }
@endphp

@section('content')

<style>
  .app-footer{
    background-color: #151935 !important;
    color:#fff !important;
  }
  .app-footer a, .app-header a{
    color:#fff !important;
  }
  .app-header .dropdown-menu a{
    color:#000 !important;
  }
  .app-header{
    background-color: #151935 !important;
    color:#fff !important;
  }
</style>

<div class="card">
  <div class="card-body" style="height:80vh">
    <h3>{{ $title }}</h3>
    @if($doc)
      <!--<iframe width="100%" style="height:70vh" src="{{asset($doc->src)}}" frameborder="0"></iframe>
      <embed src="{{asset($doc->src)}}" type="application/pdf" width="100%" style="height:70vh" />-->
      <object data="{{asset($doc->src)}}" type="application/pdf" width="100%" style="height:70vh">
        <iframe src="https://docs.google.com/viewer?url={{asset($doc->src)}}&embedded=true" width="100%" style="height:70vh"></iframe>
      </object>
    @else
      <h4 class="mt-5">No hay documentos cargados</h4>
    @endif
  </div>
</div>

@endsection

@push('after_styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/styles/base16/dracula.min.css">
@endpush

@push('after_scripts')
  <script src="https://use.fontawesome.com/4fde5ebf74.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/highlight.min.js"></script>
  <script>hljs.highlightAll();</script>
@endpush
