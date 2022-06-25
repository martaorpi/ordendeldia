@extends(backpack_view('blank'))

@section('content')

@php
    //$jobs = App\Models\Job::get();
    $jobs = DB::table('staff_subjects')
                 ->select('job_id', DB::raw('count(*) as total'))
                 ->groupBy('job_id')
                 ->get();
@endphp

<div class="container">
    <div class="row">
        <table class="table responsive">
            <thead>
                <tr>
                    <th>Función</th>
                    <th>Privada</th>
                    <th>Suplente SPEP</th>
                    <th>Titular SPEP</th>
                    <th>Total general</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                    <tr>
                        <td>{{ $job->job_id }}</td>
                        <td>{{ $job->total }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection