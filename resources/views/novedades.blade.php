@extends(backpack_view('blank'))

@section('content')

@php
    $jobs = App\Models\StaffSubject::select('job_id', DB::raw('count(*) as total'))->groupBy('job_id')->get();
    $licenses = App\Models\License::whereIn('id', [1, 2, 4, 15, 22, 32, 34, 35])->get();
    $staff = App\Models\Staff::where('status', 'Activo')->get();
    //$jobs = DB::table('staff_subjects')->select('job_id', DB::raw('count(*) as total'))->groupBy('job_id')->get();
@endphp

<div class="container">
    <div class="row">        
        <div class="col-12">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Cantidad por Planta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Licencias por Planta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Carga Horaria por Planta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-sanciones-tab" data-toggle="pill" href="#pills-sanciones" role="tab" aria-controls="pills-sanciones" aria-selected="false">Puntaje por Planta</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">


                    {{--<a href="/novedades/exportar-cant-planta">exportar</a>--}}
                    <a href="{{ url('novedades/exportar-cant-planta') }}" class="btn font-weight-bold" target="_blank">
                        <i class="far fa-file-excel"></i> Descargar
                    </a>


                    <table class="table table-condensed responsive" style="border-collapse:collapse;">
                        <thead class="table-danger">
                            <tr>
                                <th></th>
                                <th>Función</th>
                                <th class="text-center">Privada</th>
                                <th class="text-center">Suplente SPEP</th>
                                <th class="text-center">Titular SPEP</th>
                                <th class="text-center">Total General</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $priv_gral = 0;                                
                            $sup_spep_gral = 0;                                
                            $tit_spep_gral = 0;                                
                            @endphp
                            @foreach ($jobs as $job)
                                @php
                                $j = App\Models\Job::where('id', $job->job_id)->first();
                                $privada = 0;
                                $sup_spep = 0;
                                $tit_spep = 0;
                                if($j->id == 6 || $j->id == 11){
                                    $privada = App\Models\StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                                    ->where('job_id', $job->job_id)
                                                    ->where('plant_type', 'Privada')
                                                    ->count();
                                    $sup_spep = App\Models\StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                                    ->where('job_id', $job->job_id)
                                                    ->where('job_id', $job->job_id)->where('plant_type', 'Suplente Spep')
                                                    ->count();
                                    $tit_spep = App\Models\StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                                    ->where('job_id', $job->job_id)
                                                    ->where('job_id', $job->job_id)->where('plant_type', 'Titular Spep')
                                                    ->count();
                                    $priv_gral += $privada;
                                    $sup_spep_gral += $sup_spep;
                                    $tit_spep_gral += $tit_spep;
                                }else{
                                    foreach ($staff as $l) {
                                        if(App\Models\StaffSubject::where('plant_type', 'Privada')->where('staff_id', $l->id)->where('job_id', $job->job_id)->first()){$privada++;}
                                        if(App\Models\StaffSubject::where('plant_type', 'Suplente Spep')->where('staff_id', $l->id)->where('job_id', $job->job_id)->first()){$sup_spep++;}
                                        if(App\Models\StaffSubject::where('plant_type', 'Titular Spep')->where('staff_id', $l->id)->where('job_id', $job->job_id)->first()){$tit_spep++;}
                                    }
                                    $priv_gral += $privada;
                                    $sup_spep_gral += $sup_spep;
                                    $tit_spep_gral += $tit_spep;
                                }
                                $i=1;
                                //$staff_jobs = App\Models\Staff::where('status', 'Activo')->where('job_id', $job->job_id)->get();
                                @endphp
                                <tr data-toggle="collapse" data-target="#demo{{$job->job_id}}" class="accordion-toggle">
                                    <td width="5%">@if($privada + $sup_spep + $tit_spep > 0)<button class="btn btn-default btn-xs py-0 px-2">Ver</button>@endif</td>
                                    <td>{{ $j->description }}</td>
                                    <td class="text-center">{{ $privada }}</td>
                                    <td class="text-center">{{ $sup_spep }}</td>
                                    <td class="text-center">{{ $tit_spep }}</td>
                                    <td class="table-danger text-center">{{ $privada + $sup_spep + $tit_spep }}</td>
                                </tr>
                                {{------------------COLLAPSE OCULTO---------------}}
                                @if ($privada + $sup_spep + $tit_spep > 0)
                                    <tr>
                                        <td colspan="5" class="hiddenRow p-0">
                                            <div class="accordian-body collapse" id="demo{{$job->job_id}}"> 
                                                <table class="table table-striped m-4">
                                                    <thead class="table-danger">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Personal</th>
                                                            <th>Privada</th>
                                                            <th>Suplente SPEP</th>
                                                            <th>Titular SPEP</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if($job->job_id ==6 || $job->job_id ==11)
                                                            @php
                                                            $staff_subjects = App\Models\StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                                                    ->where('job_id', $job->job_id)
                                                                    ->whereIn('plant_type', ['Privada', 'Suplente Spep', 'Titular Spep'])
                                                                    ->get();
                                                            @endphp
                                                            @foreach ($staff_subjects as $staff_subject)
                                                                <tr>
                                                                    <td>{{ $i++ }}</td>
                                                                    <td>{{$staff_subject->staff->name}} ({{$staff_subject->subject->description}} - {{$staff_subject->subject->career->short_name}})</td>
                                                                    <td>@if($staff_subject->plant_type == 'PRIVADA') X @endif</td>
                                                                    <td>@if($staff_subject->plant_type == 'SUPLENTE SPEP') X @endif</td>
                                                                    <td>@if($staff_subject->plant_type == 'TITULAR SPEP') X @endif</td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            @php
                                                            $staff_subjects = App\Models\StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                                                    ->where('job_id', $job->job_id)
                                                                    ->whereIn('plant_type', ['Privada', 'Suplente Spep', 'Titular Spep'])
                                                                    ->get()
                                                                    ->unique('staff_id');
                                                            @endphp
                                                            @foreach ($staff_subjects as $staff_subject)
                                                                <tr>
                                                                    <td>{{ $i++ }}</td>
                                                                    <td>{{$staff_subject->staff->name}}</td>
                                                                    <td>@php if($staff_subject){if($staff_subject->plant_type == 'PRIVADA'){echo 'X';}}@endphp</td>
                                                                    <td>@php if($staff_subject){if($staff_subject->plant_type == 'SUPLENTE SPEP'){echo 'X';}}@endphp</td>
                                                                    <td>@php if($staff_subject){if($staff_subject->plant_type == 'TITULAR SPEP'){echo 'X';}}@endphp</td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                        {{--@foreach ($staff as $staff_job)
                                                            @php
                                                            $staff_subjects = App\Models\StaffSubject::where('staff_id', $staff_job->id)
                                                                        ->whereIn('plant_type', ['Privada', 'Suplente Spep', 'Titular Spep'])
                                                                        ->where('job_id', $job->job_id)
                                                                        ->get();
                                                            @endphp
                                                            @if($staff_job->job_id == 6)
                                                                @foreach ($staff_subjects as $staff_subject)
                                                                    <tr>
                                                                        <td>{{ $i++ }}</td>
                                                                        <td>{{$staff_job->name}} ({{$staff_subject->subject->description}} - {{$staff_subject->subject->career->short_name}})</td>
                                                                        <td>@if($staff_subject->plant_type == 'PRIVADA') X @endif</td>
                                                                        <td>@if($staff_subject->plant_type == 'SUPLENTE SPEP') X @endif</td>
                                                                        <td>@if($staff_subject->plant_type == 'TITULAR SPEP') X @endif</td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                @php
                                                                $staff_subject = App\Models\StaffSubject::where('staff_id', $staff_job->id)->first();
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ $i++ }}</td>
                                                                    <td>{{$staff_job->name}}</td>
                                                                    <td>@php if($staff_subject){if($staff_subject->plant_type == 'PRIVADA'){echo 'X';}}@endphp</td>
                                                                    <td>@php if($staff_subject){if($staff_subject->plant_type == 'SUPLENTE SPEP'){echo 'X';}}@endphp</td>
                                                                    <td>@php if($staff_subject){if($staff_subject->plant_type == 'TITULAR SPEP'){echo 'X';}}@endphp</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach--}}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                {{-------------------------------------------------}}
                            @endforeach
                            <tr class="table-danger">
                                <th></th>
                                <th>Total General</th>
                                <td class="text-center">{{ $priv_gral }}</td>
                                <td class="text-center">{{ $sup_spep_gral }}</td>
                                <td class="text-center">{{ $tit_spep_gral }}</td>
                                <th class="text-center">{{ $priv_gral + $sup_spep_gral + $tit_spep_gral }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <table class="table responsive">
                        <thead class="table-danger">
                            <tr>
                                <th></th>
                                <th>Licencia</th>
                                <th class="text-center">Privada</th>
                                <th class="text-center">Suplente SPEP</th>
                                <th class="text-center">Titular SPEP</th>
                                <th class="text-center">Total General</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $priv_gral = 0;                                
                            $sup_spep_gral = 0;                                
                            $tit_spep_gral = 0;     

                            $mes_ant = date('m', strtotime('-1 month'));
                            $mes = date('m');
                            $mes_sig = date('m', strtotime('+1 month'));

                            $year_ant = date('Y', strtotime('-1 year'));
                            $year = date('Y');
                            $year_sig = date('Y', strtotime('+1 year'));

                            if(date('d') > 20){
                                if($mes == 12){
                                    $date1 = $year.$mes.'-20';
                                    $date2 = $year_sig.'01-20';
                                }else{
                                    $date1 = $year.'-'.$mes.'-20';
                                    $date2 = $year.'-'.$mes_sig.'-20';
                                }
                            }else{
                                if($mes == 1){
                                    $date1 = $year_ant.'-12-20';
                                    $date2 = $year.$mes.'-20';
                                }else{
                                    $date1 = $year.'-'.$mes_ant.'-20';
                                    $date2 = $year.'-'.$mes.'-20';
                                }
                            }

                            @endphp
                            @foreach ($licenses as $license)
                                @php
                                $staff_licenses = App\Models\StaffLicense::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                                ->where('license_id', $license->id)
                                                ->where(function($q) use ($date1, $date2){
                                                    $q->whereBetween('start_date', [$date1, $date2])
                                                    ->orWhere('end_date', null);
                                                })
                                                ->get();
                                $privada = 0;
                                $sup_spep = 0;
                                $tit_spep = 0;
                                foreach ($staff_licenses as $staff_license) {
                                    //$planta = App\Models\Subject::where('staff_id', $staff_license->staff->id)->first();
                                    //foreach ($staff_license->staff->subjects as $subject) {
                                        if($staff_license->staff->subjects[0]->pivot->plant_type == 'PRIVADA'){$privada++;}
                                        if($staff_license->staff->subjects[0]->pivot->plant_type == 'SUPLENTE SPEP'){$sup_spep++;}
                                        if($staff_license->staff->subjects[0]->pivot->plant_type == 'TITULAR SPEP'){$tit_spep++;}
                                    //}
                                }
                                $priv_gral += $privada;
                                $sup_spep_gral += $sup_spep;
                                $tit_spep_gral += $tit_spep;
                                $i=1;
                                @endphp
                                <tr data-toggle="collapse" data-target="#demo{{$license->id}}" class="accordion-toggle">
                                    <td width="5%">@if($privada + $sup_spep + $tit_spep > 0)<button class="btn btn-default btn-xs py-0 px-2">Ver</button>@endif</td>
                                    <td>{{ $license->article }}</td>
                                    <td class="text-center">{{ $privada }}</td>
                                    <td class="text-center">{{ $sup_spep }}</td>
                                    <td class="text-center">{{ $tit_spep }}</td>
                                    <td class="table-danger text-center">{{ $privada + $sup_spep + $tit_spep }}</td>
                                </tr>
                                {{------------------COLLAPSE OCULTO---------------}}
                                @if ($privada + $sup_spep + $tit_spep > 0)
                                    <tr>
                                        <td colspan="5" class="hiddenRow p-0">
                                            <div class="accordian-body collapse" id="demo{{$license->id}}"> 
                                                <table class="table table-striped m-4">
                                                    <thead class="table-danger">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Personal</th>
                                                            <th>Privada</th>
                                                            <th>Suplente SPEP</th>
                                                            <th>Titular SPEP</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($staff_licenses as $staff_license)
                                                            @php
                                                            $prueba = App\Models\StaffSubject::where('staff_id', $staff_license->staff->id)->first();
                                                            @endphp
                                                            <tr>
                                                                <td>{{ $i++ }}</td>
                                                                <td>{{$staff_license->staff->name}}</td>
                                                                <td>@php if($prueba){if($prueba->plant_type == 'PRIVADA'){echo 'X';}}@endphp</td>
                                                                <td>@php if($prueba){if($prueba->plant_type == 'SUPLENTE SPEP'){echo 'X';}}@endphp</td>
                                                                <td>@php if($prueba){if($prueba->plant_type == 'TITULAR SPEP'){echo 'X';}}@endphp</td>
                                                                {{--<td>@if($staff_license->staff->subjects[0]->pivot->plant_type == 'PRIVADA') X @endif</td>
                                                                <td>@if($staff_license->staff->subjects[0]->pivot->plant_type == 'SUPLENTE SPEP') X @endif</td>
                                                                <td>@if($staff_license->staff->subjects[0]->pivot->plant_type == 'TITULAR SPEP') X @endif</td>--}}
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                {{-------------------------------------------------}}
                            @endforeach
                            <tr class="table-danger">
                                <th></th>
                                <th>Total General</th>
                                <td class="text-center">{{ $priv_gral }}</td>
                                <td class="text-center">{{ $sup_spep_gral }}</td>
                                <td class="text-center">{{ $tit_spep_gral }}</td>
                                <th class="text-center">{{ $priv_gral + $sup_spep_gral + $tit_spep_gral }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <table class="table table-condensed responsive" style="border-collapse:collapse;">
                        <thead class="table-danger">
                            <tr>
                                <th></th>
                                <th>Función</th>
                                <th class="text-center">Privada</th>
                                <th class="text-center">Suplente SPEP</th>
                                <th class="text-center">Titular SPEP</th>
                                <th class="text-center">Total General</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $priv_gral = 0;                                
                            $sup_spep_gral = 0;                                
                            $tit_spep_gral = 0;                                
                            @endphp
                            @foreach ($jobs as $job)
                                @php
                                $j = App\Models\Job::where('id', $job->job_id)->first();
                                $privada = App\Models\StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                                ->where('job_id', $job->job_id)
                                                ->where('plant_type', 'Privada')
                                                ->sum('weekly_hours');
                                $sup_spep = App\Models\StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                                ->where('job_id', $job->job_id)
                                                ->where('job_id', $job->job_id)->where('plant_type', 'Suplente Spep')
                                                ->sum('weekly_hours');
                                $tit_spep = App\Models\StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                                ->where('job_id', $job->job_id)
                                                ->where('job_id', $job->job_id)->where('plant_type', 'Titular Spep')
                                                ->sum('weekly_hours');
                                $priv_gral += $privada;
                                $sup_spep_gral += $sup_spep;
                                $tit_spep_gral += $tit_spep;
                                $staff_jobs = App\Models\StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                                ->where('job_id', $job->job_id)
                                                ->whereIn('plant_type', ['Privada', 'Suplente Spep', 'Titular Spep'])
                                                ->get();
                                $i=1;
                                @endphp
                                <tr data-toggle="collapse" data-target="#demo{{$job->job_id}}" class="accordion-toggle">
                                    <td width="5%">@if($privada + $sup_spep + $tit_spep > 0)<button class="btn btn-default btn-xs py-0 px-2">Ver</button>@endif</td>
                                    <td>{{ $j->description }}</td>
                                    <td class="text-center">{{ $privada }}</td>
                                    <td class="text-center">{{ $sup_spep }}</td>
                                    <td class="text-center">{{ $tit_spep }}</td>
                                    <td class="table-danger text-center">{{ $privada + $sup_spep + $tit_spep }}</td>
                                </tr>
                                {{------------------COLLAPSE OCULTO---------------}}
                                @if ($privada + $sup_spep + $tit_spep > 0)
                                    <tr>
                                        <td colspan="5" class="hiddenRow p-0">
                                            <div class="accordian-body collapse" id="demo{{$job->job_id}}"> 
                                                <table class="table table-striped m-4">
                                                    <thead class="table-danger">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Personal</th>
                                                            <th>Privada</th>
                                                            <th>Suplente SPEP</th>
                                                            <th>Titular SPEP</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($staff_jobs as $staff_job)
                                                            <tr>
                                                                <td>{{ $i++ }}</td>
                                                                <td>{{$staff_job->staff->name}}</td>
                                                                <td>@if($staff_job->plant_type == 'PRIVADA') {{$staff_job->weekly_hours}} @endif</td>
                                                                <td>@if($staff_job->plant_type == 'SUPLENTE SPEP') {{$staff_job->weekly_hours}} @endif</td>
                                                                <td>@if($staff_job->plant_type == 'TITULAR SPEP') {{$staff_job->weekly_hours}} @endif</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                {{-------------------------------------------------}}
                            @endforeach
                            <tr class="table-danger">
                                <th></th>
                                <th>Total General</th>
                                <td class="text-center">{{ $priv_gral }}</td>
                                <td class="text-center">{{ $sup_spep_gral }}</td>
                                <td class="text-center">{{ $tit_spep_gral }}</td>
                                <th class="text-center">{{ $priv_gral + $sup_spep_gral + $tit_spep_gral }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="pills-sanciones" role="tabpanel" aria-labelledby="pills-sanciones-tab">
                    <table class="table table-condensed responsive" style="border-collapse:collapse;">
                        <thead class="table-danger">
                            <tr>
                                <th></th>
                                <th>Función</th>
                                <th class="text-center">Privada</th>
                                <th class="text-center">Suplente SPEP</th>
                                <th class="text-center">Titular SPEP</th>
                                <th class="text-center">Total General</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $priv_gral = 0;                                
                            $sup_spep_gral = 0;                                
                            $tit_spep_gral = 0;                                
                            @endphp
                            @foreach ($jobs as $job)
                                @php
                                $j = App\Models\Job::where('id', $job->job_id)->first();
                                $privada = App\Models\StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                                ->where('job_id', $job->job_id)
                                                ->where('plant_type', 'Privada')
                                                ->get();
                                $privada = count($privada) * $j->score;
                                                
                                $sup_spep = App\Models\StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                                ->where('job_id', $job->job_id)
                                                ->where('plant_type', 'Suplente Spep')
                                                ->get();
                                $sup_spep = count($sup_spep) * $j->score;

                                $tit_spep = App\Models\StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                                ->where('job_id', $job->job_id)
                                                ->where('plant_type', 'Titular Spep')
                                                ->get();
                                $tit_spep = count($tit_spep) * $j->score;

                                $priv_gral += $privada;
                                $sup_spep_gral += $sup_spep;
                                $tit_spep_gral += $tit_spep;
                                $staff_jobs = App\Models\StaffSubject::selectRaw('staff_id, plant_type')
                                                ->whereHas('staff', function($q){$q->where('status', 'Activo');})
                                                ->where('job_id', $job->job_id)
                                                ->whereIn('plant_type', ['Privada', 'Suplente Spep', 'Titular Spep'])
                                                ->groupBy(['staff_id', 'plant_type'])
                                                ->get();
                                $i=1;
                                
                                @endphp

                                <tr data-toggle="collapse" data-target="#demo{{$job->job_id}}" class="accordion-toggle">
                                    <td width="5%">@if($privada + $sup_spep + $tit_spep > 0)<button class="btn btn-default btn-xs py-0 px-2">Ver</button>@endif</td>
                                    <td>{{ $j->description }}</td>
                                    <td class="text-center">{{ $privada }}</td>
                                    <td class="text-center">{{ $sup_spep }}</td>
                                    <td class="text-center">{{ $tit_spep }}</td>
                                    <td class="table-danger text-center">{{ $privada + $sup_spep + $tit_spep }}</td>
                                </tr>
                                {{------------------COLLAPSE OCULTO---------------}}
                                @if ($privada + $sup_spep + $tit_spep > 0)
                                    <tr>
                                        <td colspan="5" class="hiddenRow p-0">
                                            <div class="accordian-body collapse" id="demo{{$job->job_id}}"> 
                                                <table class="table table-striped m-4">
                                                    <thead class="table-danger">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Personal</th>
                                                            <th>Privada</th>
                                                            <th>Suplente SPEP</th>
                                                            <th>Titular SPEP</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($staff_jobs as $staff_job)
                                                            @php
                                                            $cant_staff = App\Models\staffSubject::where('staff_id', $staff_job->staff_id)->where('plant_type', $staff_job->plant_type)->count();
                                                            $staff = App\Models\staffSubject::where('staff_id', $staff_job->staff_id)->where('plant_type', $staff_job->plant_type)->first();
                                                            @endphp
                                                            <tr>
                                                                <td>{{ $i++ }}</td>
                                                                <td>{{$staff_job->staff->name}} ({{$cant_staff}} esp. curr.)</td>
                                                                <td>@if($staff_job->plant_type == 'PRIVADA') {{$staff->job->score * $cant_staff}} @endif</td>
                                                                <td>@if($staff_job->plant_type == 'SUPLENTE SPEP') {{$staff->job->score * $cant_staff}} @endif</td>
                                                                <td>@if($staff_job->plant_type == 'TITULAR SPEP') {{$staff->job->score * $cant_staff}} @endif</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                {{-------------------------------------------------}}
                            @endforeach
                            <tr class="table-danger">
                                <th></th>
                                <th>Total General</th>
                                <td class="text-center">{{ $priv_gral }}</td>
                                <td class="text-center">{{ $sup_spep_gral }}</td>
                                <td class="text-center">{{ $tit_spep_gral }}</td>
                                <th class="text-center">{{ $priv_gral + $sup_spep_gral + $tit_spep_gral }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection