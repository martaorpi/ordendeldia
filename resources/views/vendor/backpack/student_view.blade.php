@extends(backpack_view('blank'))

@section('content')
    
    @php
//pendiente where
        $estudiante = \App\Models\Student::with(['province','department','nationality'])->get();
        
    @endphp

    <a href="{{ asset('form_pdf')}}" target="_blank" class="btn btn-md login-submit-cs text-white" style="background: #881f1f">Imprimir Formulario de Inscipción</a>

@endsection