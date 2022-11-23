<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


{{--<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js"></script> 
<script type="text/javascript" src="http://cdn.bootcss.com/bootstrap-select/2.0.0-beta1/js/bootstrap-select.js"></script>    
<link rel="stylesheet" type="text/css" href="http://cdn.bootcss.com/bootstrap-select/2.0.0-beta1/css/bootstrap-select.css">    
  
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">  
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>  --}}


<style>
    button.btn.dropdown-toggle.btn-default {
        background-color: #fff !important;
        margin:0;
        box-shadow: none;
    }
    button.btn.dropdown-toggle.btn-default:hover {
        background-color: #fff !important;
    }
    span.caret{margin:-2px -2px 0 0 !important;}
    .btn.dropdown-toggle.bs-placeholder.btn-light{
        padding: 15px 5px 10px 15px;
        margin:0;
        background-color: #fff !important;
        box-shadow: none;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        color: #000 !important;
    }
    .btn-light.dropdown-toggle {
        padding: 15px 5px 10px 15px;
        margin:0;
        background-color: #fff !important;
        box-shadow: none;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        color: #000 !important;
    }
    .filter-option-inner-inner {
        margin-top: -10px !important;
    }
    .linea_bordo{
        border: solid 1px #881f1f;
    }
    .btn_bordo{
        background: #881f1f !important;
    }
</style>

@php
    $careers = App\Models\Career::with('students_with_space', 'students_with_spaceA')->get();
    
    $nacionalidades = App\Models\Nationality::get();
    $provincias = App\Models\Province::get();
    $departamentos = App\Models\Department::get();
    $estudiante = App\Models\Student::where('user_id', auth()->user()->id)->where('cycle_id', 2)->with(['career','province','department','nationality','documentation'])->first();
    //$localidades = App\Models\Location::orderBy('description', 'asc')->get();
@endphp

<div class="mx-5 px-5 my-5">
    <h3 class="text-center"><b>FORMULARIO DE PREINSCRIPCIÓN</b></h3><br>

    <p><b>Lea atentamente toda la información brindada. Una vez aceptada y presentada la ficha de preinscripción la misma adquiere el carácter de Declaración Jurada.</b></p>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <p>Corrige los siguientes errores:</p>
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ url('formulario-inscripcion') }}" class="" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <div class="col-12">
                <hr class="linea_bordo">
            </div>
        </div>
       
        <div class="form-group row">
            <div class="col-12">
                <label for="carrera">Carrera Nivel Superior No Universitario</label>
                <select class="form-control" id="carrera" name="career_id" required>
                    <option value="">Seleccione</option>
                    @foreach ($careers as $key => $career)
                        {{$career}}
                        @if ($career->status == 'Abierta')
                            @if ($career->available_space > $career->students_with_space->count() + $career->students_with_spaceA->count())
                                @if ($estudiante)
                                    <option value="{{ $career->id }}" {{($estudiante->career_id==$career->id)? 'selected':''}}>{{ $career->title }}</option>
                                @else
                                    <option value="{{ $career->id }}">{{ $career->title }} </option>
                                @endif
                            @else
                                <option value="{{ $career->id }}" {{(old('career_id')==$career->id)? 'selected':''}} disabled>{{ $career->title }} {{$career->available_space}} <i>(Sin Cupo)</i></option>
                            @endif
                        @else
                            <option value="{{ $career->id }}" {{(old('career_id')==$career->id)? 'selected':''}} disabled>{{ $career->title }} <i>(Cerrada)</i></option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div id="ts" class="col-12 text-danger mt-2"></div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <hr class="linea_bordo mb-4">
                <h6><b>DATOS PERSONALES</b></h6>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12 col-lg-6">
                <label for="apellido">Apellidos (Completo)</label>
                @if ($estudiante)
                    <input type="text" class="form-control" id="apellido" name="last_name" value="{{ $estudiante->last_name }}" required>
                @else
                    <input type="text" class="form-control" id="apellido" name="last_name" value="{{ old('last_name') }}" required>
                @endif
            </div>

            <div class="col-12 col-lg-6">
                <label for="nombre">Nombres (Completo)</label>
                @if ($estudiante)
                    <input type="text" class="form-control" id="nombre" name="first_name" value="{{ $estudiante->first_name }}" required>
                @else
                    <input type="text" class="form-control" id="nombre" name="first_name" value="{{ old('first_name')}}" required>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12 col-lg-6">
                <label for="dni">D.N.I. Nº</label>
                @if ($estudiante)
                    <input type="number" class="form-control" id="dni" name="dni" value="{{ $estudiante->dni }}" required>
                @else
                    <input type="number" class="form-control" id="dni" name="dni" value="{{ old('dni')}}" required>
                @endif
            </div>

            <div class="col-12 col-lg-6">
                <label for="fecha_nac">Fecha de Nacimiento</label>
                @if ($estudiante)
                    <input type="date" class="form-control" id="fecha_nac" name="date_birth" value="{{ $estudiante->date_birth }}" required>
                @else
                    <input type="date" class="form-control" id="fecha_nac" name="date_birth" value="{{ old('date_birth')}}" required>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12 col-lg-6">
                <label for="fijp">Teléfono Fijo</label>
                @if ($estudiante)
                    <input type="text" class="form-control" id="fijp" name="landline" value="{{ $estudiante->landline }}" >
                @else
                    <input type="text" class="form-control" id="fijp" name="landline" value="{{ old('landline')}}" >
                @endif
            </div>

            <div class="col-12 col-lg-6">
                <label for="celular">Teléfono Celular</label>
                @if ($estudiante)
                    <input type="text" class="form-control" id="celular" name="cell_phone" value="{{ $estudiante->cell_phone }}" required>
                @else
                    <input type="text" class="form-control" id="celular" name="cell_phone" value="{{ old('cell_phone')}}" required>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <label for="nacionalidad">Nacionalidad</label>
                <select class="form-control selectpicker" data-live-search="true" id="nacionalidad" name="nationality_id" required>
                    <option value="">Seleccione</option>
                    @foreach ($nacionalidades as $nacionalidad)
                        @if ($estudiante)
                            <option value="{{ $nacionalidad->id }}" {{($estudiante->nationality_id==$nacionalidad->id)? 'selected':''}}>{{ $nacionalidad->description }}</option>
                        @else
                            <option value="{{ $nacionalidad->id }}" {{(old('nationality_id')==$nacionalidad->id)? 'selected':''}}>{{ $nacionalidad->description }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="form-group row">
            <div class="col-12">
                <hr class="linea_bordo mb-4">
                <h6><b>DOMICILIO REAL (Domicilio en el que reside actualmente)</b></h6>
            </div>
        </div>

        <div class="form-group row">
            
            <div class="col-12">
                <label for="provincia">Provincia</label>
                <select class="form-control selectpicker" data-live-search="true" id="provincia" name="province_id" disabled>
                    <option value="">Seleccione</option>
                    @foreach ($provincias as $provincia)
                        @if ($estudiante)
                            <option value="{{ $provincia->id }}" {{($estudiante->province_id==$provincia->id)? 'selected':''}}>{{ $provincia->description }}</option>
                        @else
                            <option value="{{ $provincia->id }}" {{(old('province_id')==$provincia->id)? 'selected':''}}>{{ $provincia->description }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <label for="departamento">Departamento</label>
                <select class="form-control selectpicker" data-live-search="true" id="departamento" name="department_id" disabled>
                    <option value="">Seleccione</option>
                    @foreach ($departamentos as $departamento)
                        @if ($estudiante)
                            <option value="{{ $departamento->id }}" {{($estudiante->department_id==$departamento->id)? 'selected':''}}>{{ $departamento->description }}</option>
                        @else
                            <option value="{{ $departamento->id }}" {{(old('department_id')==$departamento->id)? 'selected':''}}>{{ $departamento->description }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <label for="localidad">Localidad</label>
                <select class="form-control selectpicker" data-live-search="true" id="localidad" name="location_id" disabled>
                    @if ($estudiante)
                        <option value="{{ $estudiante->location_id }}">{{ $estudiante->location->description }}</option>
                    @else
                        <option value="">Seleccione</option>
                    @endif
                </select>
            </div>
        </div>
        
        <div class="form-group row">
            <div class="col-12">
                <label for="direccion">Dirección</label>
                @if ($estudiante)                    
                    <textarea class="form-control" id="direccion" name="address" required>{{ $estudiante->address }}</textarea>
                @else
                    <textarea class="form-control" id="direccion" name="address" required>{{ old('address')}}</textarea>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <hr class="linea_bordo mb-4">
                <h6><b>DOMICILIO LEGAL (Domicilio que figura en su DNI)</b></h6>
            </div>
        </div>

        <div class="form-group row">
            
            <div class="col-12">
                <label for="provinciaL">Provincia</label>
                <select class="form-control selectpicker" data-live-search="true" id="provinciaL" name="province_legal_id" disabled>
                    <option value="">Seleccione</option>
                    @foreach ($provincias as $provincia)
                        @if ($estudiante)
                            <option value="{{ $provincia->id }}" {{($estudiante->province_legal_id==$provincia->id)? 'selected':''}}>{{ $provincia->description }}</option>
                        @else
                            <option value="{{ $provincia->id }}" {{(old('province_legal_id')==$provincia->id)? 'selected':''}}>{{ $provincia->description }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <label for="departamentoL">Departamento</label>
                <select class="form-control selectpicker" data-live-search="true" id="departamentoL" name="department_legal_id" disabled>
                    <option value="">Seleccione</option>
                    @foreach ($departamentos as $departamento)
                        @if ($estudiante)
                            <option value="{{ $departamento->id }}" {{($estudiante->department_legal_id==$departamento->id)? 'selected':''}}>{{ $departamento->description }}</option>
                        @else
                            <option value="{{ $departamento->id }}" {{(old('department_legal_id')==$departamento->id)? 'selected':''}}>{{ $departamento->description }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <label for="localidadL">Localidad</label>
                <select class="form-control selectpicker" data-live-search="true" id="localidadL" name="location_legal_id" disabled>
                    @if ($estudiante)
                        <option value="{{ $estudiante->location_legal_id }}">{{ $estudiante->location->description }}</option>
                    @else
                        <option value="">Seleccione</option>
                    @endif
                </select>
            </div>
        </div>
        
        <div class="form-group row">
            <div class="col-12">
                <label for="direccionL">Dirección</label>
                @if ($estudiante)                    
                    <textarea class="form-control" id="direccionL" name="address_legal" required>{{ $estudiante->address_legal }}</textarea>
                @else
                    <textarea class="form-control" id="direccionL" name="address_legal" required>{{ old('address_legal')}}</textarea>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <hr class="linea_bordo mb-3">
                <h6><b>REQUISITOS</b></h6>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <b>Adjunte la documentación requerida: (sólo puede adjuntar archivos en formatos png, jpg, jpeg y pdf)</b>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12 col-lg-8">
                <label>1- Certificados de Estudios Secundarios (copia) o constancia de finalización de estudios sin adeudar materias.</label><br>
                <small><b>Adjunte un único archivo</b></small>
            </div>
    
            <div class="col-12 col-lg-4">
                @if ($estudiante)
                    <input type="file" class="form-control-file" name="files[]" multiple>
                    @php 
                        $file_calificaion_estudiante = $estudiante->documentation->where('description', 'Certificado de Estudios')->last()->src;
                        $file = explode('/',$file_calificaion_estudiante);
                    @endphp
                    <a href="{{ $file_calificaion_estudiante }}">{{ $file[3] }}</a>
                @else
                    <input type="file" class="form-control-file" name="files[]" multiple value="{{ old('files[]') }}" required>
                @endif
                    <input type="hidden" value="Certificado de Estudios" name="description0">

            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <hr class="linea_bordo">
            </div>
        </div>

        <div class="form-group row">
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Términos y condiciones</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" style="overflow-y: scroll; height:500px;">
                        <p><b>REGLAMENTO INTERNO DE LOS ESTUDIANTES INSTITUTO DE ESTUDIOS SUPERIORES SAN MARTÍN DE PORRES</b></p>
                        <p><b>DE LA CALIDAD DE ESTUDIANTE:</b></p>
                        <p class="text-justify"><b>Artículo 1º: </b>Son estudiantes del Instituto de Estudios Superiores San Martin de
                            Porres, quienes se encuentren matriculados de acuerdo con las disposiciones
                            reglamentarias y conserven sus derechos de asistir a clase y rendir exámenes,
                            conforme lo establecido en el presente Reglamento Interno de Estudiantes
                            (RIE), Reglamento Académico Marco (RAM) y en Reglamento Académico
                            Institucional (RAI).
                        </p>
                        <p class="text-justify"><b>Artículo 2º: </b>El presente régimen es aplicable a todos los estudiantes por los
                            actos que realicen en el establecimiento o fuera de éstos, en tanto afecten a la
                            Institución, con motivo u ocasión del ejercicio de su calidad de estudiantes.
                        </p>
                        <p class="text-justify"><b>Artículo 3º: </b>Es propósito de esta Institución que el estudiante:<br>
                            * Gestione su trayectoria educativa integral, para obtener su titulación.<br>
                            * Articule la teoría con la práctica profesionalizante, posibilitando la<br>
                            transferencia de lo aprendido para el desarrollo de competencias
                            específicas del futuro campo laboral.<br>
                            * Reflexione críticamente acerca del perfil profesional.<br>
                            * Participe de la vida institucional, promoviendo los valores formulados en el
                            PEI (Proyecto Educativo Institucional).<br>
                            * Asuma un proyecto de vida considerando los principios de la ecología
                            integral, tanto en su vida cotidiana como en la profesional.
                        </p>
                        <p><b>DE LOS DERECHOS Y OBLIGACIONES DEL ESTUDIANTE:</b></p>
                        <p class="text-justify"><b>Artículo 4º: </b>Son derechos del estudiante, los enunciados en la Ley de
                            Educación Nacional nº 26.206, Arts.125, 126, los establecidos en la Ley
                            Provincial de Educación nº 6.876, Ley de Educación Superior nº 24.521, y los
                            siguientes:<br>
                            a- recibir una formación técnica integral, profesional y ética, cualificada por
                            su orientación humanística cristiana, acorde a las características y
                            necesidades del sistema educativo, competencias profesionales y a la
                            realidad sociocultural del contexto;<br>
                            b- acceso a una educación de calidad, inclusiva y plural basada en los
                            Valores y Principios Pedagógicos del ISMP;<br>
                            c- conocer los lineamientos y planes de estudio que regulan su trayectoria
                            académica;<br>
                            d- tener acceso al conocimiento de los reglamentos y disposiciones de
                            aplicación en el Instituto y las garantías y procedimientos dispuestos para
                            la defensa de sus derechos;<br>
                            e- recibir asistencia, orientación y comunicación asertiva así como un trato
                            respetuoso, en todo momento;<br>
                            f- participar de eventos académicos y culturales que enriquezcan su
                            formación profesional y humana;<br>
                            g- expresarse y peticionar cortésmente de manera libre, responsable, con
                            adhesión a las prácticas reglamentadas y principios democráticos;<br>
                            h- hacer un uso responsable y cuidadoso de los insumos, recursos
                            materiales, equipamientos y de todas las dependencias físicas y digitales
                            del Instituto; con especial cuidando de los recursos energéticos, como una
                            forma de colaborar con el cuidado de la casa común;<br>
                            i- tener la posibilidad de acceder al beneficio de una beca “Martín de
                            Porres” siempre y cuando cumpla con los requisitos establecidos en su
                            reglamentación;<br>
                            j- al reconocimiento de sus méritos académicos, plasmados en la elección
                            de portadores de bandera y cuadro de honor del Instituto.
                        </p>
                        <p class="text-justify"><b>Artículo 5º: </b>Son deberes de los estudiantes, los establecidos en la Ley de
                            Educación Nacional 26.206 Art.127, los que se establezcan en la Ley Provincial
                            de Educación nº 6.876, y los siguientes:<br>
                            a- conocer y cumplir el presente Reglamento y demás disposiciones de
                            aplicación en el Instituto referentes al régimen y modalidad de cursado,
                            planes de estudio, matriculación, pago de cuotas, regularidad de las
                            materias, inscripción a exámenes, uso del campus virtual, práctica
                            profesionalizante y toda otra cuestión atinente al desarrollo de su carrera;<br>
                            b- asumir con autonomía y responsabilidad su trayectoria académica, con
                            atención al régimen de correlatividad del Plan de estudios vigente;<br>
                            c- conservar y presentar, cuando sea requerida, la documentación que
                            acredite trámites de inscripción o pagos de matriculación, cuotas u otros
                            conceptos, siendo esta documentación el único comprobante válido;<br>
                            d- dar una información fehaciente y veraz ante los requerimientos de la
                            Institución. El estudiante es responsable por toda omisión o información
                            errónea que suministre a la misma;<br>
                            e- la estudiante embarazada debe comunicar de inmediato, mediante
                            documentación fehaciente a las autoridades y/o responsables de su
                            práctica profesionalizante, su estado de gestante, a los efectos de
                            consensuar con la institución una alternativa para el cursado de la misma.
                            Ante el incumplimiento de este deber de comunicación, la estudiante se
                            responsabilizará de cualquier inconveniente en su salud y/o en la de su
                            hijo, así como en su trayectoria académica, que puedan surgir por esta
                            omisión;<br>
                            f- mantener un trato respetuoso con todos los miembros de la comunidad
                            educativa, fomentando el espíritu de iniciativa, colaboración y solidaridad,
                            absteniéndose de toda actitud partidaria, discriminatoria, agresiva o
                            lesiva de la convivencia dentro del Instituto;<br>
                            g- procurar la mejor formación académica y cultural, haciendo uso activo de
                            los espacios institucionales y externos dispuestos al efecto;<br>
                            h- estudiar y esforzarse por conseguir el máximo desarrollo según sus
                            capacidades y posibilidades;<br>
                            i- asistir a clases (presenciales o virtuales) regularmente y con puntualidad;<br>
                            j- participar de todas las actividades formativas y complementarias,
                            Integrándose activamente a la vida institucional;<br>
                            k- respetar la libertad de conciencia, las convicciones y la dignidad, la
                            autoridad legítima, la integridad e intimidad de todos los miembros de la
                            comunidad educativa;<br>
                            l- participar y colaborar en la mejora de la convivencia educativa y en la
                            consecución de un adecuado ámbito de estudio en la Institución;<br>
                            m-conservar y hacer un buen uso de las instalaciones, equipamientos y
                            materiales didácticos del establecimiento educativo;<br>
                            n- completar las “encuestas de control de calidad” al terminar de cursar una
                            unidad curricular, en el Campus virtual;<br>
                            o- presentar Carnet de Vacunas establecido por el ministerio de salud de la
                            nación, priorizando la aplicación de las dosis de BCG, Doble adultos (DT:
                            Difteria-Tétanos), Hepatitis B, Antigripal (se esperará hasta el inicio de la
                            campaña anual), y toda otra vacuna que las autoridades educativas y/o
                            sanitarias provinciales y nacionales establezcan como obligatorias.
                        </p>
                        <p><b>DEL INGRESO Y PERMANENCIA DE LOS ESTUDIANTES:</b></p>
                        <p class="text-justify"><b>Artículo 6º: </b>El Instituto San Martín de Porres tiene derecho de admisión de
                            acuerdo a las siguientes indicaciones:<br>
                            a- De admisión a personas que manifiesten no estar de acuerdo con el
                            ideario de la institución.<br>
                            b- Se reserva el derecho de admisión o readmisión de aquellos estudiantes
                            que no reúnan las capacidades físicas o psicológicas imprescindibles para el
                            desarrollo del perfil profesional consignado en el plan de estudio de cada
                            carrera, verificado esto por condiciones objetivas o por la incapacidad para
                            aprobar los exámenes exigibles para acreditar la capacidad profesional según el
                            Marco de referencia del INET, para cada carrera.<br>
                            c- Se reserva el derecho de readmisión de los estudiantes que manifiesten
                            conductas violentas, descontroladas, o que hayan tenido sanciones
                            disciplinarias.<br>
                            d- Se reserva el derecho de admisión y/o readmisión de estudiantes que
                            adeuden cuotas u otros conceptos al momento de producirse la inscripción para
                            el año lectivo correspondiente.
                        </p>
                        <p class="text-justify"><b>Artículo 7º: </b>: El Instituto tiene derecho a:<br>
                            a- Exigir el cumplimiento del presente reglamento.<br>
                            b- Exigir la documentación que acredite el pago del servicio educativo
                            brindado por el instituto, comprende: matrícula anual, cuotas mensuales y
                            recargos por fuera de términos.
                        </p>
                        <p><b>DE LA CONDICIÓN DE ESTUDIANTE:</b></p>
                        <p class="text-justify"><b>Artículo 8º: </b>La condición de estudiante del Instituto de Estudios Superiores San
                            Martín de Porres se adquiere con la aceptación de su inscripción en la sede
                            del mismo.
                        </p>
                        <p class="text-justify"><b>Artículo 9º: </b>Para la inscripción de ingresantes se requieren tres pasos:<br>
                            <p><b>1. Preinscripción:</b></p>
                            <p class="text-justify">a. Completar la solicitud de inscripción vía web.<br>
                                b. Adjuntar título de Nivel secundario legalizado y certificado por la
                                autoridad competente, o bien certificado de título en trámite, que
                                caduca en el mes de mayo, del año en curso.</p>
                            <p><b>2. Matricula:</b></p>
                            <p class="text-justify">a. Pago del arancel correspondiente, que no será reembolsable bajo
                                ningún concepto.</p>
                            <p><b>3. Inscripción </b>presentar en la institución en formato papel:</p>
                            <p class="text-justify">a. Acta de nacimiento legalizada o acta de nacimiento original.<br>
                                b. Fotocopia de DNI, frente y reverso.<br>
                                c. Constancia de CUIL (si no figura en el DNI).<br>
                                d. 2 fotos carnet color.<br>
                                e. Certificado de antecedentes personales, provincial.<br>
                                f. Firma de un Acuerdo Específico con el estudiante. Anexo I.<br>
                                g. Realizar el Taller propedéutico o inicial.<br>
                                h. Presentación de la ficha de salud psicofísica según especificaciones
                                de la misma.</p>
                        </p>
                        <p class="text-justify"><b>Artículo 10º: </b>Los ingresantes al primer año de todas las carreras del instituto,
                            deberán cursar un taller propedéutico, el cual estará limitado por el orden de
                            matriculación y según la disponibilidad de los centros de práctica
                            profesionalizante de cada carrera. Es facultad de la rectoría establecer la
                            modalidad y fecha de los mismos, dentro los plazos previstos en el calendario
                            académico de la jurisdicción.
                        </p>
                        <p class="text-justify"><b>Artículo 11º: </b>Los aspirantes que adeuden una o dos materias del nivel medio
                            pueden inscribirse provisoriamente a través de la página web a una lista de
                            espera hasta el mes de abril.
                        </p>
                        <p class="text-justify"><b>Artículo 12º: </b>La condición de estudiante regular debe ser renovada cada año
                            lectivo, en las fechas previstas por la Institución, según la modalidad que
                            establezca la autoridad educativa del instituto.<br>
                            La inscripción implica conocimiento y aceptación por parte del estudiante, de
                            cualquier cambio de norma administrativa vigente al momento de hacer efectiva
                            la misma.
                        </p>
                        <p class="text-justify"><b>Artículo 13º: </b>El Instituto San Martín de Porres se reserva el derecho de
                            admisión, inscripción y readmisión de estudiantes o ex estudiantes, que hayan
                            incurrido en faltas graves de indisciplina o que adeuden cuotas de años
                            anteriores.
                        </p>
                        <p><b>Artículo 14º: </b>De la matrícula anual del alumno regular:<br>
                            <p class="text-justify">a- No registrar deuda con el instituto.<br>
                            b- No tener sanciones disciplinarias graves.<br>
                            c- Cumplir con el régimen de correlatividades según Plan de estudios vigente.<br>
                            d- Pago de la matrícula del año en curso.</p>
                        </p>
                        <p class="text-justify"><b>Artículo 15º: </b>Todo estudiante matriculado que no cumplimente los requisitos
                            para ser estudiante regular, solo podrá asistir a las clases de una carrera,
                            conforme los requisitos de solicitud y las limitaciones dispuestas en el Anexo II
                            del presente, en calidad de “oyente”.
                        </p>
                        <p class="text-justify"><b>Artículo 16º: </b>El estudiante regular deberá tener las cuotas
                            al día al momento
                            de inscribirse para las mesas de exámenes, usando el sistema de inscripción
                            que la institución determine, caso contrario no podrá presentarse a las mismas.
                            La administración puede dispensar excepcionalmente dicha exigencia previo
                            análisis del caso en particular.                            
                        </p>
                        <p><b>Artículo 17º: </b>La caducidad de la condición de estudiante regular se
                            <p class="text-justify">a- Manifestación expresa del interesado, dirigida por correo electrónico a
                                Bedelía, con copia a Coordinador académico de la carrera, conforme modelo de
                                nota obrante en Anexo III.<br>
                            b- Falta de cumplimiento del acto registral que se establece en el Artículo 8° y
                            9°.<br>
                            c- Por expulsión del establecimiento ante una falta grave, acreditada con el
                            debido proceso.<br>
                            d- Por haber egresado de la carrera en la que se encontraba inscripto.</p>
                        </p>

                        <p><b>COMPROMISO CON LA INSTITUCIÓN</b></p>
                        <p class="text-justify">Por medio de la presente, declaro conocer y aceptar todas las disposiciones contenidas en los reglamentos del Instituto Superior San Martin de Porres, referentes a las condiciones académicas, disciplinarias, de matriculación, abono de cuota y otros conceptos. Comprometiéndome de plena conformidad y propia voluntad a respetarlos estrictamente.</p>
                        <br>
                        <p><b>INFORMACIÓN IMPORTATE A TENER EN CUENTA</b></p>
                        <br>
                        <p class="text-justify"><b>USTED ADQUIRIRÁ LA CPMDICIÓN DE ESTUDIANTE REGULAR CON LA INSCRIPCIÓN DEFINITIVA, QUE COMPRENDE: EL CUMPLIMIENTO DE TODOS LOS REQUISITOS EXIGIDOS Y LA ASISTENCIA AL TALELR PROPEDÉUTICO.</b></p>
                        <br>
                        <P class="text-justify">* La inscripción será validada a partir del día hábil inmediato siguiente al vencimiento del cupón de pago, dentro de las fechas establecidas por la institución y la presentación de la documentación correspondiente (Ver Anexo I).</P>
                        <br>
                        <p class="text-justify">* Por el pago de la inscripción el ingresante tiene derecho a realizar el taller propedéutico <b>NO SIENDO EL MONTO REINTEGRABLE POR NINGÚN CONCEPTO.</b></p>
                        <br>
                        <p class="text-justify">* Los montos fijados para las cuotas mensuales pueden ser modificadas por el instituto a lo largo del ciclo lectivo, en caso de que haya una variación significativa en la estructura de costos internos.</p>
                        <br>
                        <p class="text-justify">* Los alumnos que registren deuda de cuotas al momento de rendir exámenes parciales y/o finales, NO PODRÁN INSCRIBIRSE a los mismos hasta tanto no regularicen su situación.</p>
                        <br>
                        <p class="text-justify">* Los alumnos que requieran Certificación de Finalización de Estudios y/o Constancia de Título en trámite, NO PODRÁN solicitarla si registran deuda con el Instituto, hasta tanto no regularicen su situación.</p>
                        <br>
                        <p class="text-justify"><b>Declaro Bajo Fe de Juramento que la documentación que acompaño digitalmente es verdadera, conociendo las disposiciones del titulo XII (delitos contra la fé pública) Capítulo III (falsificación de documentos) del Código Penal Argentino.</b></p>
                        <br>
                        <p><b>Anexo I</b></p>
                        -  Formulario virtual impreso.</br>
                        -  Fotocopia del DNI.</br>
                        -  Dos (2) foto carnet 4x4.</br>
                        -  Certificado de finalización de estudios o título secundario.</br>
                        -  Firma del Acuerdo <a href="https://ismp.edu.ar/files/Acuerdo-ISMP.pdf" target="blank">(Descargar)</a>.</br>
                        -  Certificado Residencia.</br>
                        -  Carpeta colgante (tipo fichero).</br>
                        <b>Hasta el 28 de Abril tienes para presentar la siguiente documentación:</b></br>
                        -  Ficha de Aptitud Psicofísica <a href="https://ismp.edu.ar/files/FichaSalud-ISMP.pdf" target="blank">(Descargar)</a>.</br>
                        -  Certificado de antecedentes penales (expedido por la policía de la provincia de Santiago del Estero o de la provincia en la que tenga residencia).</br>
                        -  Acta de nacimiento actualizada y legalizada.</br>
                    </div>
                    <div class="modal-footer">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="terminos" onchange="toggleCheckbox(this)" disabled>
                            <label class="form-check-label pl-4" for="terminos">
                               He leído y aceptado de Conformidad
                            </label>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                Antes de enviar el formulario por favor lea los 
                <a href = "#" data-toggle="modal" data-target="#exampleModal">
                    Terminos y condiciones 
                </a>
            </div>
        </div>
        
        <button type="submit" class="btn btn_bordo text-white btn-block" disabled="true" id="btn-actualizar">Enviar</button>
    </form>
</div>


<script>
    $(function() {
        if(document.getElementById('nacionalidad').value == 1){
            $("#provincia").attr('disabled',false);
            $("#provinciaL").attr('disabled',false);
            //$('#provincia').selectpicker('refresh');
        }
        
        if(document.getElementById('provincia').value == 1){
            $("#departamento").attr('disabled',false);
            $("#departamento").prop('required',true);

            $("#localidad").attr('disabled',false);
            $("#localidad").prop('required',true);
        }

        if(document.getElementById('provinciaL').value == 1){
            $("#departamentoL").attr('disabled',false);
            $("#departamentoL").prop('required',true);

            $("#localidadL").attr('disabled',false);
            $("#localidadL").prop('required',true);
        }

        $("#nacionalidad").change( function(event) {
            if ($(this).val() == 1) {
                $("#provincia").attr('disabled',false);
                $("#provincia").prop('required',true);

                $("#provinciaL").attr('disabled',false);
                $("#provinciaL").prop('required',true);
             
                if(document.getElementById('provincia').value == 1){
                    $("#departamento").attr('disabled',false);
                    $("#departamento").prop('required',true);

                    $("#localidad").attr('disabled',false);
                    $("#localidad").prop('required',true);
                }

                if(document.getElementById('provinciaL').value == 1){
                    $("#departamentoL").attr('disabled',false);
                    $("#departamentoL").prop('required',true);

                    $("#localidadL").attr('disabled',false);
                    $("#localidadL").prop('required',true);
                }
            } else {
                $("#provincia").attr('disabled',true);
                $('#provincia').selectpicker('refresh');

                $("#provinciaL").attr('disabled',true);
                $('#provinciaL').selectpicker('refresh');

                $("#departamento").attr('disabled',true);
                $("#departamentoL").attr('disabled',true);

                $("#localidad").attr('disabled',true);
                $("#localidadL").attr('disabled',true);
            }
        });
 
        $("#provincia").change(function(event){
            if ($(this).val() == 1) {
                $("#departamento").attr('disabled',false);
                $("#departamento").prop('required',true);

                $("#localidad").attr('disabled',false);
                $("#localidad").prop('required',true);
            } else {
                $("#departamento").attr('disabled',true);

                $("#localidad").attr('disabled',true);
            }
        });

        $("#provinciaL").change(function(event){
            if ($(this).val() == 1) {
                $("#departamentoL").attr('disabled',false);
                $("#departamentoL").prop('required',true);

                $("#localidadL").attr('disabled',false);
                $("#localidadL").prop('required',true);
            } else {
                $("#departamentoL").attr('disabled',true);

                $("#localidadL").attr('disabled',true);
            }
        });

        $("#departamento").change(function(event){
            $("#localidad").attr('disabled',false);
            $.get("getLocalidades/"+event.target.value,function(response,indicador){
                $("#localidad").empty();
                for(i=0; i<response.length; i++){
                    $("#localidad").append("<option value='"+response[i].id+"'>"+response[i].description+"</option>");
                }
            });
        });

        $("#departamentoL").change(function(event){
            $("#localidadL").attr('disabled',false);
            $.get("getLocalidades/"+event.target.value,function(response,indicador){
                $("#localidadL").empty();
                for(i=0; i<response.length; i++){
                    $("#localidadL").append("<option value='"+response[i].id+"'>"+response[i].description+"</option>");
                }
            });
        });

        $("#carrera").change(function(event){
            if ($(this).val() == 1) {
                $("#ts").html('La carrera de Trabajo Social tiene una duración de 4 años.'+
                            '<br>'+
                            ' Con la posibilidad de articular con el cilco complemetario de UNSTA (Universidad del Norte Santo Tomás de Aquino), de 2 años más de duración, para obtener el título de Lic. en Trabajo Social.')
            }else{
                $('#ts').html('');
            }
        });

        $('.modal-body').on("scroll", function() {
            var scrollHeight = $(document).height();
            var scrollPosition = $('.modal-body').height() + $('.modal-body').scrollTop();
            if ((scrollHeight - scrollPosition) / scrollHeight < -0.7) {
                document.getElementById("terminos").disabled = false;
                //alert((scrollHeight - scrollPosition) / scrollHeight)
            }
           
        });


    });

    function toggleCheckbox(element)
    {
        if (element.checked) {
            document.getElementById("btn-actualizar").disabled = false;
        }else{
            document.getElementById("btn-actualizar").disabled = true;            
        }
    }
</script>