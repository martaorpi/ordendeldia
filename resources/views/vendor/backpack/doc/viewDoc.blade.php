@php
$doc = App\Models\Doc::orderBy('updated_at', 'desc')->first();
@endphp

<div class="card">
  <div class="card-body" style="height:75vh">
    <div class="row">
      <div class="col-12">
        <object data="{{asset($doc->src)}}" type="application/pdf" width="100%" style="height:70vh">
          <iframe src="https://docs.google.com/viewer?url={{asset($doc->src)}}&embedded=true" width="100%" style="height:70vh"></iframe>
        </object>
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
