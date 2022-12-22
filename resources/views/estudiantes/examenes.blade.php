<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="py-12">
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
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>
                                <form>
                                    <button type="submit" class="btn btn-primary">Inscribir</button>
                                </form>
                            </td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>
                                <form>
                                    <button type="submit" class="btn btn-primary">Inscribir</button>
                                </form>
                            </td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>
                                <form>
                                    <button type="submit" class="btn btn-primary">Inscribir</button>
                                </form>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>