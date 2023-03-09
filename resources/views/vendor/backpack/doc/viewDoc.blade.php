@php
$doc = App\Models\Doc::orderBy('updated_at', 'desc')->first();
@endphp

<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-12">
        <iframe width="100%" height="700" src="{{asset($doc->src)}}" frameborder="0"></iframe>
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
