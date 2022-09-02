@extends(backpack_view('blank'))

@section('content')

@php
    $valor_indice_2022 = 149.68;
    $jobs = App\Models\Job::where('id',16)->first();
    $basico = $jobs->score * $valor_indice_2022;
    //$licenses = App\Models\License::whereIn('id', [1, 2, 15, 32, 34, 35])->get();
    //$staff = App\Models\Staff::where('status', 'Activo')->get();
    //$jobs = DB::table('staff_subjects')->select('job_id', DB::raw('count(*) as total'))->groupBy('job_id')->get();
@endphp

<div class="container">
    <div class="row">        
        <div class="col-12">
            <h4>EJEMPLO: Secretario con 5 años de antiguedad<h4><br>
            Básico: {{ $basico }}
            Antiguedad: {{ $basico * 0.30 }}
        </div>
    </div>
</div>

@endsection