@extends(backpack_view('blank'))

@section('content')
//boton atras
    {{$entry->last_name}}
    {{$entry->first_name}}
    ///{{$entry->nationality}}///
    @php
        //$estudiante = \App\Models\Student::where('user_id', $entry->id)->with(['province','department','nationality'])->get();
    @endphp


    //src documentaciones
    //boton alta en el sistema de cobranza
    //

    <form action="{{url('/form_pdf_post')}}" method="get" target="_blank">
        <input type="hidden" id="f_id" name="f_id" value="{{$entry->id}}"><br><br>

        <input type="submit" value="Formulario de Inscipción" class="btn btn-md login-submit-cs text-white" style="background: #881f1f">
    </form>
@endsection