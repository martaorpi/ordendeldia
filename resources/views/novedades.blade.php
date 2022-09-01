@extends(backpack_view('blank'))

@section('content')

@php
    $jobs = App\Models\StaffSubject::select('job_id', DB::raw('count(*) as total'))->groupBy('job_id')->get();
    $licenses = App\Models\License::whereIn('id', [1, 2, 15, 32, 34, 35])->get();
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
                                                                <td>@if($staff_job->plant_type == 'PRIVADA') X @endif</td>
                                                                <td>@if($staff_job->plant_type == 'SUPLENTE SPEP') X @endif</td>
                                                                <td>@if($staff_job->plant_type == 'TITULAR SPEP') X @endif</td>
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
                            @endphp
                            @foreach ($licenses as $license)
                                @php
                                $staff_licenses = App\Models\StaffLicense::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                                ->where('license_id', $license->id)
                                                ->get();
                                $privada = 0;
                                $sup_spep = 0;
                                $tit_spep = 0;
                                foreach ($staff_licenses as $staff_license) {
                                    foreach ($staff_license->staff->subjects as $subject) {
                                        if($subject->pivot->plant_type == 'PRIVADA'){$privada++;}
                                        if($subject->pivot->plant_type == 'SUPLENTE SPEP'){$sup_spep++;}
                                        if($subject->pivot->plant_type == 'TITULAR SPEP'){$tit_spep++;}
                                    }
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
                                                            $prueba = App\Models\StaffSubject::where('staff_id', $staff_license->staff->id)
                                                                ->first();
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
                                                ->sum('charge_score_ismp');
                                $sup_spep = App\Models\StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                                ->where('job_id', $job->job_id)
                                                ->where('job_id', $job->job_id)->where('plant_type', 'Suplente Spep')
                                                ->sum('charge_score_ismp');
                                $tit_spep = App\Models\StaffSubject::whereHas('staff', function($q){$q->where('status', 'Activo');})
                                                ->where('job_id', $job->job_id)
                                                ->where('job_id', $job->job_id)->where('plant_type', 'Titular Spep')
                                                ->sum('charge_score_ismp');
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
                                                                <td>@if($staff_job->plant_type == 'PRIVADA') {{$staff_job->charge_score_ismp}} @endif</td>
                                                                <td>@if($staff_job->plant_type == 'SUPLENTE SPEP') {{$staff_job->charge_score_ismp}} @endif</td>
                                                                <td>@if($staff_job->plant_type == 'TITULAR SPEP') {{$staff_job->charge_score_ismp}} @endif</td>
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