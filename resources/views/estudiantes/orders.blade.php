 
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
                    <p class="h3 text-center">ORDENES DE PAGO</p>
                    
                    <table class="table mt-3">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">id</th>
                            <th scope="col">amount</th>
                            <th scope="col">updated_at</th>
                            <th scope="col">create_at</th>
                            <th scope="col">state</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($orders as $order)
                            <tr>
                              <th scope="row">1</th>
                              <td>{{ $order->id }}</td>
                              <td>${{ $order->amount }}</td>
                              <td>{{ $order->updated_at }}</td>
                              <td>{{ $order->create_at }}</td>
                              <td>{{ $order->state }}</td>
                              <td>
                                  <form>
                                      <button type="submit" class="btn btn-primary">Pagar</button>
                                  </form>
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