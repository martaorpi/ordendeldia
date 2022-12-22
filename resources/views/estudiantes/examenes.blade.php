@php
  /*$dj = \App\Models\SwornDeclaration::where('id',$id)->first();
  if($dj->type == 'Examen Regular'){*/
      $subjects = \App\Models\Subject::where('study_plan_id',auth()->user()->student[0]->study_plan->id)
          /*->whereHas('sworn_declaration_item', function ($q){$q
              ->whereHas('regularity', function ($q){$q
                  ->where('date_from', '<', date('Y-m-d'))
                  ->orWhere('date_to', '>', date('Y-m-d'));
              });
          })
          ->whereHas('correlative', function ($q){$q
              ->where('condition', 'Cursado')
              ->where('correlativity_type', 'Fuerte')
              ->whereHas('sworn_declaration_item', function ($q){$q
                  ->whereHas('exam_student', function ($q){$q
                      ->where('approved',1)
                      ->orWhere('promotion',1);
                  });
              });
          })
          ->orWhereHas('correlative', function ($q){$q
              ->where('condition', 'Cursado')
              ->where('correlativity_type', 'Débil')
              ->whereHas('sworn_declaration_item', function ($q){$q
                  ->whereHas('regularity', function ($q){$q
                      ->where('date_from', '<', date('Y-m-d'))
                      ->orWhere('date_to', '>', date('Y-m-d'));
                  });
              });
          })
          ->with('exam_table')*/
          ->whereHas('exam_table', function ($q){$q->where('current', 1);})
          ->get();
  /*}elseif($dj->type == 'Examen Libre'){
      $subjects = \App\Models\Subject::where('study_plan_id',$dj->student->study_plan->id)
          ->where('description', 'not like', "sem%")
          ->where('description', 'not like', "taller%")
          ->where('description', 'not like', "practica%")
          ->where('description', 'not like', "práctica%")
          ->whereHas('correlative', function ($q){$q
              ->where('condition', 'Cursado')
              ->where('correlativity_type', 'Fuerte')
              ->whereHas('sworn_declaration_item', function ($q){$q
                  ->whereHas('exam_student', function ($q){$q
                      ->where('approved',1)
                      ->orWhere('promotion',1);
                  });
              });
          })
          ->orWhereHas('correlative', function ($q){$q
              ->where('condition', 'Cursado')
              ->where('correlativity_type', 'Débil')
              ->whereHas('sworn_declaration_item', function ($q){$q
                  ->whereHas('regularity', function ($q){$q
                      ->where('date_from', '<', date('Y-m-d'))
                      ->orWhere('date_to', '>', date('Y-m-d'));
                  });
              });
          })
          ->get();
  }*/
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
                    <p class="h3 text-center">EXÁMENES</p>
                    <table class="table mt-3">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Asignatura</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Fecha Cierre</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($subjects as $subject)
                            <tr>
                              <th scope="row">1</th>
                              <td>{{ $subject->description }}</td>
                              
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>