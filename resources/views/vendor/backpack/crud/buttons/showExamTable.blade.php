@php
/*$url = url()->full();
$url = explode('job_id=',$url);
if(sizeof($url) > 1){
    echo $url[1];
}else{
    echo 'no';
}*/
@endphp

{{--<a href="{{ url()->full().'/export' }} " class="btn btn-xs btn-default"><i class="fa fa-ban"></i> Listado de Cargos</a>--}}
<a href="{{ 'exam-inscriptions?full_name='.$entry->getKey() }} " class="btn btn-xs btn-default"><i class="fa fa-ban"></i> Ver Inscriptos</a>