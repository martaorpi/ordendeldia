<div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200 row">
                  <div class="col-2">
                      <img src="images/user.png" alt="">
                  </div>
                  <div class="col-10">
                      <h5 class="mt-4">{{ $staff->name }} </h5>
                      <div class="table-responsive">
                          <table class="table table-sm">
                              <thead>
                                  <tr>
                                      <th scope="col">Cargos/Asignaciones</th>
                                      <th scope="col">Función</th>
                                      <th scope="col">Fecha Alta</th>
                                      <th scope="col">Fecha Baja</th>
                                      <th scope="col">HR/HC</th>
                                      <th scope="col">Días</th>
                                      <th scope="col">Lugar</th>
                                      <th scope="col">Afectacion presupuestaria</th>
                                  </tr>
                              </thead>
                              <tbody>

                                @foreach ($staff->subjects as $subject)
                                    @php $job = App\Models\Job::where('id', $subject->pivot->job_id)->first(); @endphp
                                    <tr>
                                        <td>{{ $subject->description }} (Cód {{ $subject->code }})</td>
                                        <td>{{ $job->description }}</td>
                                        <td>@if($subject->pivot->start_date != Null) {{ date("d-m-Y", strtotime($subject->pivot->start_date)) }}@endif</td>
                                        <td>@if($subject->pivot->end_date != Null) {{ date("d-m-Y", strtotime($subject->pivot->end_date)) }}@endif</td>
                                        <td>{{ $subject->pivot->weekly_hours }}</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            {{ $subject->pivot->plant_type }}
                                            @if($job->id == 6)
                                                @if($subject->pivot->plant_type=='SUPLENTE SPEP')
                                                    @php $staff_tit = App\Models\StaffSubject::where('subject_id', $subject->id)->where('plant_type', 'TITULAR SPEP')->get(); @endphp
                                                    @foreach ($staff_tit as $s)
                                                        <br><small>(TITULAR: {{$s->staff->name}})</small>
                                                    @endforeach
                                                @endif
                                                @if($subject->pivot->plant_type=='TITULAR SPEP')
                                                    @php $staff_tit = App\Models\StaffSubject::where('subject_id', $subject->id)->where('plant_type', 'SUPLENTE SPEP')->get(); @endphp
                                                    @foreach ($staff_tit as $s)
                                                        <br><small>(SUPLENTE: {{$s->staff->name}})</small>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                              </tbody>
                          </table>
                      </div>    
                  </div>
              </div>
              <hr>
              <div class="mx-5 mt-4">
                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">SIt. Revista</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Carga de Flia.</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Licencias</a>
                      </li>
                      {{--<li class="nav-item">
                          <a class="nav-link" id="pills-sanciones-tab" data-toggle="pill" href="#pills-sanciones" role="tab" aria-controls="pills-sanciones" aria-selected="false">Sanciones</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="pills-evaluacion-tab" data-toggle="pill" href="#pills-evaluacion" role="tab" aria-controls="pills-evaluacion" aria-selected="false">Evaluación de desempeño</a>
                      </li>--}}
                      <li class="nav-item">
                          <a class="nav-link" id="pills-datosacademicos-tab" data-toggle="pill" href="#pills-datosacademicos" role="tab" aria-controls="pills-datosacademicos" aria-selected="false">Datos Académicos</a>
                      </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <b>{{ $staff->status }}</b><br>
                        Alta en el ISMP: <b>{{ date("d-m-Y", strtotime($staff->start_date)) }}</b><br>
                        Tiempo estimado jubilación:
                        @php
                            $diff = date_diff(date_create($staff->date_birth), date_create(date("Y-m-d")));
                            $age = $diff->format('%y');

                            $diff2 = date_diff(date_create($staff->start_contributions), date_create(date("Y-m-d")));
                            $contributions = $diff2->format('%y');

                            $diff3 = date_diff(date_create($staff->start_date), date_create(date("Y-m-d")));
                            $date_ismp = $diff3->format('%y');
                        @endphp
                        @if($job->id != 6 && $job->id != 7 && $job->id != 8 && $job->id != 9 && $job->id != 11 && $job->id != 16 && $job->id != 17)
                            @php
                                if($staff->sex == 'F'){$edad_min = 60;}else{$edad_min = 65;}

                                if($age < $edad_min){
                                    $jubilacion_x_edad = $edad_min - $age;
                                }else{$jubilacion_x_edad = 0;}

                                if($contributions < 30){
                                    $jubilacion_x_aportes = 30 - $contributions;
                                }else{$jubilacion_x_aportes = 0;}

                                if($jubilacion_x_edad > $jubilacion_x_aportes){
                                    $jubilacion = $jubilacion_x_edad;
                                    $fecha_estimada = date("d-m-Y", strtotime(date("Y-m-d", strtotime($staff->date_birth)) . " + ".$age+$jubilacion." year"));
                                }else{
                                    $jubilacion = $jubilacion_x_aportes;
                                    if($staff->start_contributions != Null){
                                        $fecha_estimada = date("d-m-Y", strtotime(date("Y-m-d", strtotime($staff->start_contributions))."+".$contributions+$jubilacion." year"));
                                    }else{
                                        $fecha_estimada = date("d-m-Y", strtotime(date("Y-m-d")."+".$contributions+$jubilacion." year"));;
                                    }
                                }
                            @endphp
                        @else
                            @php
                                if($staff->sex == 'F'){$edad_min = 60;}else{$edad_min = 65;}

                                if($age < $edad_min){
                                    $jubilacion_x_edad = $edad_min - $age;
                                }else{$jubilacion_x_edad = 0;}

                                if($contributions < 25){
                                    $jubilacion_x_aportes = 25 - $contributions;
                                }else{$jubilacion_x_aportes = 0;}

                                if($jubilacion_x_edad > $jubilacion_x_aportes){
                                    $jubilacion = $jubilacion_x_edad;
                                    $fecha_estimada = date("d-m-Y", strtotime(date("Y-m-d", strtotime($staff->date_birth))."+".$age+$jubilacion." year"));
                                }else{
                                    $jubilacion = $jubilacion_x_aportes;
                                    if($staff->start_contributions != Null){
                                        $fecha_estimada = date("d-m-Y", strtotime(date("Y-m-d", strtotime($staff->start_contributions))."+".$contributions+$jubilacion." year"));
                                    }else{
                                        $fecha_estimada = date("d-m-Y", strtotime(date("Y-m-d")."+".$contributions+$jubilacion." year"));;
                                    }
                                }
                            @endphp
                        @endif
                        {{ $jubilacion }} años - Fecha estimada: <b>{{ $fecha_estimada }}</b>
                        <br><br>
                        @foreach ($staff->subjects as $subject)
                            @php $job = App\Models\Job::where('id', $subject->pivot->job_id)->first(); @endphp
                            <b>Función:</b> {{ $job->description }} - <i>"{{ $subject->description }}" (Cód {{ $subject->code }})</i>
                            <table class="table">
                                <tr>
                                    <th>Fecha de Alta</th>
                                    <th>Fecha de Baja</th>
                                    <th>Resolucion nro</th>
                                    <th>Convenio colectivo de trabajo</th>
                                </tr> 
                                <tr>
                                    <td>@if($subject->pivot->start_date != Null) {{ date("d-m-Y", strtotime($subject->pivot->start_date)) }} @endif</td>
                                    <td>@if($subject->pivot->end_date != Null) {{ date("d-m-Y", strtotime($subject->pivot->end_date)) }} @endif</td>
                                    <td>{{ $subject->pivot->resolution_number }}</td>
                                    <td>{{ $subject->pivot->plant_type }}</td>
                                </tr>   
                            </table>
                            <br>
                        @endforeach
                          
                          {{--Remuneracion bruta<br>
                          <table class="table">
                              <tr>
                                  <th>Ene</th>
                                  <th>Feb</th>
                                  <th>Mar</th>
                                  <th>Abr</th>
                                  <th>May</th>
                                  <th>Jun</th>
                                  <th>SAC</th>
                                  <th>Jul</th>
                                  <th>Ago</th>
                                  <th>Sep</th>
                                  <th>Oct</th>
                                  <th>Nov</th>
                                  <th>Dic</th>
                                  <th>SAC</th>
                                  <th>Total</th>
                              </tr>
                              <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                              </tr>
                          </table>--}}
                      </div>
                      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                          <table class="table">
                              <tr>
                                  <th>Vínculo</th>
                                  <th>Apellido y Nombre</th>
                                  <th>DNI</th>
                                  <th>Edad</th>
                              </tr>
                              @foreach ($staff->family_members as $family)
                                @php
                                $cumpleanos = new DateTime($family->date_birth);
                                $hoy = new DateTime();
                                $annos = $hoy->diff($cumpleanos);
                                @endphp
                                <tr>
                                    <td>{{ $family->link }}</td>
                                    <td>{{ $family->name }}</td>
                                    <td>{{ $family->dni }}</td>
                                    <td>{{ $annos->y }}</td>
                                </tr>
                              @endforeach
                          </table>
                      </div>
                      <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                          <table class="table">
                              <tr>
                                  <th>Art</th>
                                  <th>Cant. Dias</th>
                                  <th>Fecha Inicio</th>
                                  <th>Fecha Fin</th>
                              </tr>
                              @foreach ($staff->licenses as $license)
                                <tr>
                                    <td>{{ $license->article }}</td>
                                    <td>{{ $license->pivot->requested_days }}</td>
                                    <td>{{ $license->pivot->start_date }}</td>
                                    <td>{{ $license->pivot->end_date }}</td>
                                </tr>
                              @endforeach
                          </table>
                      </div>
                      {{--<div class="tab-pane fade" id="pills-sanciones" role="tabpanel" aria-labelledby="pills-sanciones-tab">
                          <table class="table">
                              <tr>
                                  <th>Tipo</th>
                                  <th>Art</th>
                                  <th>Sup. Aplica</th>
                                  <th>Motivo</th>
                                  <th>Descripcion</th>
                              </tr>
                              <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                              </tr>
                          </table>
                      </div>
                      <div class="tab-pane fade" id="pills-evaluacion" role="tabpanel" aria-labelledby="pills-evaluacion-tab">
                          evaluación de superior jerarquico<br>
                          <table class="table">
                              <tr>
                                  <th>puntualidad</th>
                                  <th>capacidad de gestion</th>
                                  <th>relacion con pares</th>
                                  <th>formacion profesional</th>
                                  <th>total</th>
                              </tr>
                              <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                              </tr>
                          </table>
                          evaluacion de estudiantes<br>
                          evaluacion subordinados<br>
                          evaluacion de pares<br>
                      </div>--}}
                      <div class="tab-pane fade" id="pills-datosacademicos" role="tabpanel" aria-labelledby="pills-datosacademicos-tab">
                          formacion terciaria (titulo, establecimiento, año)<br>
                          formacion de grado (titulo, establecimiento, año)<br>
                          formacion de posgrado<br>
                          cursos<br>
                          habilidades (informatica, pedagogia, formacion de gestion)<br>
                      </div>
                  </div>
              </div>
          </div>
      </div>
</div>
