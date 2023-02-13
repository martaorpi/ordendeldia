
<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 row">
                    <div class="col-2">
                        <img src="../../images/user.png" alt="">
                    </div>
                    <div class="col-10">
                        <h1>Nombre</h1><br>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Cargos/Asignaciones</th>
                                        <th scope="col">Función</th>
                                        <th scope="col">Fecha Alta</th>
                                        <th scope="col">HR/HC</th>
                                        <th scope="col">Días</th>
                                        <th scope="col">Lugar</th>
                                        <th scope="col">Afectacion presupuestaria</th>
                                        <th scope="col">Tpo estim. jubilación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Anatomía I</td>
                                        <td>Docente</td>
                                        <td>02/03/2022</td>
                                        <td>8 hs catedra</td>
                                        <td>lunes de 17 a 19 hs<br>martes de 19 a 20 hs</td>
                                        <td>Aula 1</td>
                                        <td>Planta Subvencionada</td>
                                        <td>2 años y 3 meses</td>
                                    </tr>
                                    <tr>
                                        <td>Área de Sistemas</td>
                                        <td></td>
                                        <td>02/03/2022</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Planta Privada</td>
                                        <td>---</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>    
                    </div>
                </div>
                <div class="mx-5">
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
                        <li class="nav-item">
                            <a class="nav-link" id="pills-sanciones-tab" data-toggle="pill" href="#pills-sanciones" role="tab" aria-controls="pills-sanciones" aria-selected="false">Sanciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-evaluacion-tab" data-toggle="pill" href="#pills-evaluacion" role="tab" aria-controls="pills-evaluacion" aria-selected="false">Evaluación de desempeño</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-datosacademicos-tab" data-toggle="pill" href="#pills-datosacademicos" role="tab" aria-controls="pills-datosacademicos" aria-selected="false">Datos Académicos</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            Activo<br><br>
                            Funcion: Docente Materia 1<br>
                            <table class="table">
                                <tr>
                                    <th>Fecha de alta</th>
                                    <th>Fecha de baja</th>
                                    <th>Resolucion nro</th>
                                    <th>Convenio colectivo de trabajo</th>
                                </tr> 
                                <tr>
                                    <td>a</td>
                                    <td>b</td>
                                    <td>c</td>
                                    <td>d</td>
                                </tr>   
                            </table>
                            <br>
                            Funcion: Docente Materia 2<br>
                            <table class="table">
                                <tr>
                                    <th>Fecha de alta</th>
                                    <th>Fecha de baja</th>
                                    <th>Resolucion nro</th>
                                    <th>Convenio colectivo de trabajo</th>
                                </tr> 
                                <tr>
                                    <td>d</td>
                                    <td>e</td>
                                    <td>f</td>
                                    <td>g</td>
                                </tr>   
                            </table>
                            <br>
                            Remuneracion bruta<br>
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
                            </table>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <table class="table">
                                <tr>
                                    <th>Vínculo</th>
                                    <th>Appellido y Nombre</th>
                                    <th>Cuil</th>
                                    <th>Edad</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <table class="table">
                                <tr>
                                    <th>Tipo</th>
                                    <th>Art</th>
                                    <th>Cant. Dias</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
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
                        <div class="tab-pane fade" id="pills-sanciones" role="tabpanel" aria-labelledby="pills-sanciones-tab">
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
                        </div>
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
</x-app-layout>

