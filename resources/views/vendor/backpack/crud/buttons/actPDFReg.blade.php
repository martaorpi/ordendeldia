@php
/*$url = url()->full();
$url = explode('job_id=',$url);
if(sizeof($url) > 1){
    echo $url[1];
}else{
    echo 'no';
}*/
@endphp

{{--<a href="{{ url()->full().'/export' }} " class="btn btn-xs btn-default"><i class="fa fa-ban"></i> Listado de Cargos</a>
<a href="{{ 'exam-inscriptions?full_name='.$entry->getKey() }} " class="btn btn-xs btn-default"><i class="fa fa-ban"></i> Acta de Examen</a>
<a href="{{ url($crud->route.'/'.$entry->getKey().'/actPDF') }} " class="btn btn-xs btn-default"><i class="fa fa-ban"></i> Acta de Examen</a>
<a href="{{ 'exam-table/act_pdf_reg/28' }} " class="btn btn-xs btn-default" target="blank"><i class="fa fa-ban"></i> Acta Regulares</a>--}}
<a href="{{ url($crud->route.'/act_pdf_reg/'.$entry->getKey()) }} " class="btn btn-xs btn-default"><i class="fa fa-ban"></i> Acta Regulares</a>