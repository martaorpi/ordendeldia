@php
    $subjects = \App\Models\Subject::where('study_plan_id',auth()->user()->student[0]->study_plan->id)->get();
@endphp
<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h4">
          Carrera: {{ auth()->user()->student[0]->career->title }}
        </div> 
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @include('estudiantes')
                    {{-- en DJ se debe guardar alumno_id, el cycle_id, cuatrimestre actual, fecha y el tipo (Examen Regular/Examen Libre) --}}
                    {{-- en DJ-Item se debe guardar dj_id, subject_id, status --}}
                    <p class="h3 text-center">REINSCRIPCIONES</p>
                    <table class="table mt-3">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Asignatura</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($subjects as $subject)
                            @php
                                //$mesa = \App\Models\ExamTable::where('subject_id',$subject->id)->first();
                                //$insc = \App\Models\SwornDeclaration::where('type','Cursado Regular')->first();
                                $insc2 = \App\Models\SwornDeclarationItem::where('subject_id',$subject->id)->first();
                            @endphp
                            <tr>
                              <th scope="row">{{ $subject->id }}</th>
                              @if ($subject->career_id == 1)
                                @switch($subject->four_month_period)
                                    @case(1) @php $anno = '1er Año';@endphp @break
                                    @case(2) @php $anno = '1er Año';@endphp @break
                                    @case(3) @php $anno = '2do Año';@endphp @break
                                    @case(4) @php $anno = '2do Año';@endphp @break
                                    @case(5) @php $anno = '3er Año';@endphp @break
                                    @case(6) @php $anno = '3er Año';@endphp @break
                                    @case(7) @php $anno = '4to Año';@endphp @break
                                    @case(8) @php $anno = '4to Año';@endphp @break
                                @endswitch
                                <td>{{ $subject->description }} - {{ $anno }}</td>
                              @else
                                @switch($subject->four_month_period)
                                    @case(1) @php $cuatri = '1er Cuatrimestre';@endphp @break
                                    @case(2) @php $cuatri = '2do Cuatrimestre';@endphp @break
                                    @case(3) @php $cuatri = '3er Cuatrimestre';@endphp @break
                                    @case(4) @php $cuatri = '4to Cuatrimestre';@endphp @break
                                    @case(5) @php $cuatri = '5to Cuatrimestre';@endphp @break
                                    @case(6) @php $cuatri = '6to Cuatrimestre';@endphp @break
                                @endswitch
                                <td>{{ $subject->description }} - {{ $cuatri }}</td>
                              @endif
                              
                              <td>
                                  @if (!$insc2)
                                    <a href="reinsc/{{$subject->id}}" class="btn btn-primary">Inscribirme</a>      
                                  @else
                                        <b>Nro de Inscripción: {{$insc2->id}}</b>
                                  @endif
                                          
                                  
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>