@extends(backpack_view('blank'))

<style>
.card-counter{
    box-shadow: 2px 2px 10px #DADADA;
    margin: 5px;
    padding: 20px 10px;
    background-color: #fff;
    height: 100px;
    border-radius: 5px;
    transition: .3s linear all;
  }
  .card-counter:hover{
    box-shadow: 4px 4px 20px #DADADA;
    transition: .3s linear all;
  }
  .card-counter.primary{
    background-color: #ba0101;
    color: #FFF;
  }
  .card-counter.danger{
    background-color: #ef5350;
    color: #FFF;
  }  
  .card-counter.success{
    background-color: #66bb6a;
    color: #FFF;
  }  
  .card-counter.info{
    background-color: #26c6da;
    color: #FFF;
  }  
  .card-counter i{
    font-size: 5em;
    opacity: 0.2;
  }
  .card-counter .count-numbers{
    position: absolute;
    right: 35px;
    top: 20px;
    font-size: 32px;
    display: block;
  }
  .card-counter .count-name{
    position: absolute;
    right: 35px;
    top: 65px;
    font-style: italic;
    text-transform: capitalize;
    opacity: 0.5;
    display: block;
    font-size: 18px;
  }
</style>

@section('content')

@php
    /*$widgets['before_content'][] = [
        'type'        => 'jumbotron',
        'heading'     => trans('backpack::base.welcome'),
        'content'     => trans('backpack::base.use_sidebar'),
        'button_link' => backpack_url('logout'),
        'button_text' => trans('backpack::base.logout'),
    ];*/
    $carreras = App\Models\Career::get();
    $aprobados = App\Models\Student::where('status','Solicitado')->orWhere('status','Inscripto');
    $ingresos_carrera = $aprobados->select('career_id', DB::raw('count(*) as total'))->groupBy('career_id')->get();
@endphp

<div class="container">
    <div class="row">
        @foreach ($carreras as $carrera)
            @foreach ($ingresos_carrera as $cupo)
                @if ($cupo->career_id == $carrera->id)
                    <div class="col-md-3">
                        <div class="card-counter primary">
                            <i class="fa fa-code-fork"></i>
                            <span class="count-numbers">{{$carrera->available_space - $cupo->total}}</span>
                            <span class="count-numbers2">{{$cupo->total}}</span>
                            <span class="count-name">{{$carrera->short_name}}</span>
                        </div>
                    </div>
                @endif
            @endforeach
            

    {{--<div class="col-md-3">
      <div class="card-counter danger">
        <i class="fa fa-ticket"></i>
        <span class="count-numbers">599</span>
        <span class="count-name">Instances</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter success">
        <i class="fa fa-database"></i>
        <span class="count-numbers">6875</span>
        <span class="count-name">Data</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter info">
        <i class="fa fa-users"></i>
        <span class="count-numbers">35</span>
        <span class="count-name">Users</span>
      </div>
    </div>--}}
    @endforeach
  </div>
</div>


@endsection