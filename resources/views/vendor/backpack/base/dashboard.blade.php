@extends(backpack_view('blank'))

<style>
.card-counter{
    box-shadow: 2px 2px 10px #DADADA;
    margin: 5px;
    padding: 20px 10px;
    background-color: #fff;
    height: 130px;
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
  .card-counter i{
    font-size: 5em;
    opacity: 0.2;
  }
  .card-counter .count-numbers2{
    position: absolute;
    right: 35px;
    top: 20px;
    font-size: 18px;
    display: block;
  }
  .card-counter .count-numbers{
    position: absolute;
    left: 35px;
    top: 15px;
    font-size: 32px;
    display: block;
  }
  .card-counter .count-numbers small{
    font-size: 20px !important;
  }
  .card-counter .count-name{
    position: absolute;
    right: 35px;
    top: 95px;
    font-style: italic;
    text-transform: capitalize;
    opacity: 0.6;
    display: block;
    font-size: 23px;
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
@endphp

<div class="container">
    <div class="row">
        @foreach ($carreras as $carrera)
          @php
              $aprobados = App\Models\Student::where('career_id',$carrera->id)->whereIn('status', ['Inscripto','Inscripto'])->count();
              //$ingresos_carrera = $aprobados->select('career_id', DB::raw('count(*) as total'))->groupBy('career_id')->get();
          @endphp
          <div class="col-md-4">
            <div class="card-counter primary">
                <i class="fa fa-code-fork"></i>                
                <span class="count-numbers text-center"><small>Inscriptos</small><br>{{ $aprobados }}</span>
                <span class="count-numbers2 text-center"><small>Disponible</small><br>{{ $carrera->available_space - $aprobados }}</span>
                <span class="count-name">{{$carrera->short_name}}</span>
            </div>
          </div>
            {{--@foreach ($ingresos_carrera as $cupo)
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
            @endforeach--}}
            
    @endforeach
  </div>
</div>


@endsection