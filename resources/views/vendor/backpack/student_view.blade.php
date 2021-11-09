@extends(backpack_view('blank'))

@section('content')
    
    @php

        
        $estudiante = \App\Models\Student::with(['province','department','nationality'])->get();
        
    @endphp
    {{$estudiante[0]->province}}
    @include('form_pdf', ['estudiante' => $estudiante[0]])

@endsection