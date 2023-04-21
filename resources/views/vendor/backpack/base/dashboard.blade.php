@extends(backpack_view('blank'))

<style>
    input {
        position: absolute;
        opacity: 0;
        z-index: -1;
    }
    .accordion-wrapper {
        border-radius: 4px;
        overflow: hidden;
        box-shadow: 0 4px 4px -2px rgba(0, 0, 0, 0.5);
        width: 100%;
        margin:0 auto;
    }
    .accordion {
        width: 100%;
        color: white;
        overflow: hidden;
        margin-bottom: 6px;
    }
    .accordion:last-child{margin-bottom: 0;}
    .accordion-label {
        display: flex;
        -webkit-box-pack: justify;
        justify-content: space-between;
        padding: 10px;
        background: #f1f4f8;
        font-weight: bold;
        cursor: pointer;
        font-size: 16px;
        color:#222;
    }
    .accordion-label:hover {
        background: #151935;
        color:#fff;
    }
    .accordion-label::after {
        content: "\276F";
        width: 16px;
        height: 16px;
        text-align: center;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
    }
    .accordion-content {
        max-height: 0;
        padding: 0 16px;
        color: rgba(4,57,94,1);
        background: white;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
    }
    .accordion-content p{
        margin: 0;
        color: rgba(4,57,94,.7);
        font-size: 18px;
    }
    input:checked + .accordion-label {
        background: #cfd9e7;
        color:#000;
    }
    input:checked + .accordion-label::after {
        -webkit-transform: rotate(90deg);
        transform: rotate(90deg);
    }
    input:checked ~ .accordion-content {
        max-height: 100vh;
        padding: 16px;
    }
/*-----------------POST-------------------*/
    img {max-width:100%;}
    .avator {
        border-radius:100px;
        width:48px;
        margin-right: 10px;
    }
    .tweet-wrap {
        max-width:100%;
        background: #fff;
        margin: 0 auto;
        margin-top: 10px;
        border-radius:3px;
        padding: 20px;
        border-bottom: 1px solid #e6ecf0;
        border-top: 1px solid #e6ecf0;
    }
    .tweet-header {
        display: flex;
        align-items:flex-start;
        font-size:14px;
    }
    .tweet-header-info {font-weight:bold;}
    .tweet-header-info span {
        color:#657786;
        font-weight:normal;
        margin-left: 5px;
    }
    .tweet-header-info p {
        font-weight:normal;
        margin-top: 5px;
    }
    .tweet-img-wrap {padding-left: 60px;}
    .tweet-info-counts {
        display: flex;
        margin-left: 60px;
        margin-top: 10px;
    }
    .tweet-info-counts div {
        display: flex;
        margin-right: 20px;
    }
    .tweet-info-counts div svg {
        color:#657786;
        margin-right: 10px;
    }
    @media screen and (max-width:430px){
        .tweet-header {flex-direction:column;}
        .tweet-header i {margin-bottom: 20px;}
        .tweet-header-info p {margin-bottom: 30px;}
        .tweet-img-wrap {padding-left: 0;}
        .tweet-info-counts {
            display: flex;
            margin-left: 0;
        }
        .tweet-info-counts div {margin-right: 10px;}
    }
</style>

@php
    $doc1 = App\Models\Doc::where('type','Completo')->orderBy('updated_at', 'desc')->first();
    $doc2 = App\Models\Doc::where('type','Estructura Organizacional')->orderBy('updated_at', 'desc')->first();
    $doc3 = App\Models\Doc::where('type','RRHH')->orderBy('updated_at', 'desc')->first();
    $doc4 = App\Models\Doc::where('type','Disposiciones Generales')->orderBy('updated_at', 'desc')->first();
    $doc5 = App\Models\Doc::where('type','Desarrollo Educativo')->orderBy('updated_at', 'desc')->first();
    $doc6 = App\Models\Doc::where('type','Disposiciones Judiciales')->orderBy('updated_at', 'desc')->first();
    $doc7 = App\Models\Doc::where('type','Urgentes')->orderBy('updated_at', 'desc')->first();

    $date_old = new DateTime();
    //$date_old = $date_old->modify('-24 hours');
    $date_old = $date_old->modify('-2 days');
    $date = date('Y-m-d H:i:s');
    $docs = App\Models\Doc::whereBetween('updated_at', [$date_old, $date])->orderBy('updated_at', 'desc')->get();
    //$docs2 = App\Models\Doc::select(DB::raw('t.*'))->from(DB::raw('(SELECT * FROM docs ORDER BY updated_at DESC) t'))->groupBy('t.type')->get();
    $views = 0;
    $date = '';

    function accion($id){
        echo $id;
    }
@endphp
<link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro-v6@44659d9/css/all.min.css" rel="stylesheet" type="text/css" />
@section('content')

@foreach ($docs as $doc)
    @if ($doc->type == 'Urgentes')
        @php
        $views = App\Models\ViewUser::where('doc_id', $doc->id)->count();
        $date = date('d/m/Y', strtotime($doc->created_at));
        @endphp
        <div class="tweet-wrap">
            <div class="tweet-header">
                {{--<img src="{{ asset('img/relaciones.png') }}" alt="" class="avator">--}}
                <div class="text-center mt-3">
                    <i class="fa-duotone fa-triangle-exclamation fa-2xl avator" style="--fa-primary-color: #dc3545; --fa-secondary-color: #dc3545;"></i>
                </div>
                <div class="tweet-header-info">
                    Dispociciones Judiciales Urgentes<span> {{ date('d/m/Y', strtotime($doc->created_at)) }}</span>
                    <p><a href="{{asset($doc->src)}}" target="blank" onclick="views({{$doc->id}})">{{ $doc->summary }}</a></p>
                </div>
            </div>
            <div class="tweet-info-counts">
                <div class="comments" title="usuarios que abrieron el documento">
                    <i class="fa-duotone fa-eye fa-lg mt-2" style="--fa-primary-color: #151935; --fa-secondary-color: #151935;"></i>{{-- <svg class="feather feather-message-circle sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg> --}}
                    <div class="comment-count ml-2" id="views{{$doc->id}}">{{ $views }}</div>
                </div>
            </div>
        </div>
    @endif
@endforeach

@foreach ($docs as $doc)
    @if ($doc->type != 'Urgentes')
        @php
        $views = App\Models\ViewUser::where('doc_id', $doc->id)->count();
        $date = date('d/m/Y', strtotime($doc->created_at));
        @endphp

        @switch($doc->type)
            @case('Completo') @php $title = 'Boletín Policial';@endphp @break;
            @case('Estructura Organizacional') @php $title = 'Estructura Organizacional';@endphp @break;
            @case('RRHH') @php $title = 'Recursos Humanos';@endphp @break;
            @case('Disposiciones Generales') @php $title = 'Disposiciones Generales';@endphp @break;
            @case('Desarrollo Educativo') @php $title = 'Desarrollo Educativo';@endphp @break;
            @case('Disposiciones Judiciales') @php $title = 'Disposiciones Judiciales';@endphp @break;
        @endswitch

        <div class="tweet-wrap">
            <div class="tweet-header">
                {{--<img src="{{ asset('img/relaciones.png') }}" alt="" class="avator">--}}
                <div class="text-center mt-3" style="">
                    @switch($doc->type)
                        @case('Completo') <i class="fa-duotone fa-notes fa-rotate-180 fa-2xl avator" style="--fa-primary-color: #151935; --fa-secondary-color: #151935;"></i> @break;
                        @case('Estructura Organizacional') <i class="fa-duotone fa-diagram-project fa-2xl avator" style="--fa-primary-color: #151935; --fa-secondary-color: #151935;"></i> @break;
                        @case('RRHH') <i class="fa-duotone fa-users fa-2xl avator" style="--fa-primary-color: #151935; --fa-secondary-color: #151935;"></i> @break;
                        @case('Disposiciones Generales') <i class="fa-duotone fa-file-invoice fa-2xl avator" style="--fa-primary-color: #151935; --fa-secondary-color: #151935;"></i> @break;
                        @case('Desarrollo Educativo') <i class="fa-duotone fa-graduation-cap fa-2xl avator" style="--fa-primary-color: #151935; --fa-secondary-color: #151935;"></i> @break;
                        @case('Disposiciones Judiciales') <i class="fa-duotone fa-scale-unbalanced-flip fa-2xl avator" style="--fa-primary-color: #151935; --fa-secondary-color: #151935;"></i> @break;
                    @endswitch
                </div>
                <div class="tweet-header-info">
                    {{ $title }}<span> {{ date('d/m/Y', strtotime($doc->created_at)) }}</span>
                    <p><a href="{{asset($doc->src)}}" target="blank" onclick="views({{$doc->id}})">{{ $doc->summary }}</a></p>
                </div>
            </div>
            <div class="tweet-info-counts">
                <div class="comments" title="usuarios que abrieron el documento">
                    <i class="fa-duotone fa-eye fa-lg mt-2" style="--fa-primary-color: #151935; --fa-secondary-color: #151935;"></i>{{-- <svg class="feather feather-message-circle sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg> --}}
                    <div class="comment-count ml-2" id="views{{$doc->id}}">{{ $views }}</div>
                </div>
            </div>
        </div>
    @endif
@endforeach

{{--<div class="tweet-wrap">
    <div class="tweet-header">
        <img src="{{ asset('img/relaciones.png') }}" alt="" class="avator">
        <div class="tweet-header-info">
            Título 2 <span>dependencia</span><span>. Jun 27</span>
            <p><a href="{{ asset('uploads/modelo de pdf final lector.pdf') }}" target="blank">A partir de la fecha, se procede a la CREACIÓN DEL DEPARTAMENTO DE SEGURIDAD Nº 18, con asiento en la ciudad
                de herrera, Departamento Avellaneda, dentro de la estructura Orgánica Policial, bajo la órbita de la Dirección General de
                Seguridad, ello a mérito de las consideraciones de hecho y derecho vertidas precedentemente.</a></p>
        </div>
    </div>
    <div class="tweet-img-wrap">
        <img src="{{ asset('img/homicidio.jpg') }}" alt="" class="tweet-img" width="300px">
    </div>
    <div class="tweet-info-counts">
        <div class="comments">
            <svg class="feather feather-message-circle sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
            <div class="comment-count">33</div>
        </div>

        <div class="retweets">
            <svg class="feather feather-repeat sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="17 1 21 5 17 9"></polyline><path d="M3 11V9a4 4 0 0 1 4-4h14"></path><polyline points="7 23 3 19 7 15"></polyline><path d="M21 13v2a4 4 0 0 1-4 4H3"></path></svg>
            <div class="retweet-count">397</div>
        </div>

        <div class="likes">
            <svg class="feather feather-heart sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
            <div class="likes-count">
                2.6k
            </div>
        </div>

        <div class="message">
            <svg class="feather feather-send sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
        </div>
    </div>
</div>--}}

<div class="accordion-wrapper mt-3">
    <div class="accordion">
        <input type="radio" name="radio-a" id="check1">
        <label class="accordion-label" for="check1">Boletín Policial - Orden del día</label>
        <div class="accordion-content">
            @if($doc1)
                <h5>{{ $doc1->summary }}</h5>
                <a href="{{ backpack_url('doc/'.$doc1->id.'/show') }}" class="btn btn-xs btn-primary" onclick="views({{$doc1->id}})">Ver Documento</a>
            @else
                <h5>No hay documentos cargados</h5>
            @endif
        </div>
    </div>
    {{--<div class="accordion">
        <input type="radio" name="radio-a" id="check7">
        <label class="accordion-label" for="check7">Dispociciones Judiciales Urgentes</label>
        <div class="accordion-content">
            @if($doc7)
                <h5>{{ $doc7->summary }}</h5>
                <a href="{{ backpack_url('doc/'.$doc7->id.'/show') }}" class="btn btn-xs btn-primary" onclick="views({{$doc7->id}})">Ver Documento</a>
            @else
                <h5>No hay documentos cargados</h5>
            @endif
        </div>
    </div>--}}
    <div class="accordion">
        <input type="radio" name="radio-a" id="check2">
        <label class="accordion-label" for="check2">Estructura Organizacional</label>
        <div class="accordion-content">
            @if($doc2)
                <h5>{{ $doc2->summary }}</h5>
                <a href="{{ backpack_url('doc/'.$doc2->id.'/show') }}" class="btn btn-xs btn-primary" onclick="views({{$doc2->id}})">Ver Documento</a>
            @else
                <h5>No hay documentos cargados</h5>
            @endif
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check3">
        <label class="accordion-label" for="check3">Recursos Humanos</label>
        <div class="accordion-content">
            @if($doc3)
                <h5>{{ $doc3->summary }}</h5>
                <a href="{{ backpack_url('doc/'.$doc3->id.'/show') }}" class="btn btn-xs btn-primary" onclick="views({{$doc3->id}})">Ver Documento</a>
            @else
                <h5>No hay documentos cargados</h5>
            @endif
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check4">
        <label class="accordion-label" for="check4">Disposiciones Generales</label>
        <div class="accordion-content">
            @if($doc4)
                <h5>{{ $doc4->summary }}</h5>
                <a href="{{ backpack_url('doc/'.$doc4->id.'/show') }}" class="btn btn-xs btn-primary" onclick="views({{$doc4->id}})">Ver Documento</a>
            @else
                <h5>No hay documentos cargados</h5>
            @endif
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check5">
        <label class="accordion-label" for="check5">Desarrollo Educativo</label>
        <div class="accordion-content">
            @if($doc5)
                <h5>{{ $doc5->summary }}</h5>
                <a href="{{ backpack_url('doc/'.$doc5->id.'/show') }}" class="btn btn-xs btn-primary" onclick="views({{$doc5->id}})">Ver Documento</a>
            @else
                <h5>No hay documentos cargados</h5>
            @endif
        </div>
    </div>
    <div class="accordion">
        <input type="radio" name="radio-a" id="check6">
        <label class="accordion-label" for="check6">Disposiciones Judiciales</label>
        <div class="accordion-content">
            @if($doc6)
                <h5>{{ $doc6->summary }}</h5>
                <a href="{{ backpack_url('doc/'.$doc6->id.'/show') }}" class="btn btn-xs btn-primary" onclick="views({{$doc6->id}})">Ver Documento</a>
            @else
                <h5>No hay documentos cargados</h5>
            @endif
        </div>
    </div>
</div>

@endsection

<script>
    function views(id){
        $.ajax({
            url: 'view-user/addViewsUsers/'+id,
            type: "GET",
            data : {"_token":"{{ csrf_token() }}"},
            dataType: "json",
            success:function(data)
            {
                document.getElementById('views'+id).innerHTML = data;
            }
        });
    }
</script>
