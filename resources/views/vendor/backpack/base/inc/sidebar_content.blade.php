@php
    use Illuminate\Support\Facades\Auth;
@endphp

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .espe{
        background-color: #f6cbd1;
    }
</style>
<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> Inicio</a></li>

@if (Auth::user()->hasRole('docente'))
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('exam-inscriptions') }}'><i class='nav-icon la la-question'></i> Examenes</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('regularity') }}'><i class='nav-icon la la-question'></i> Regularidades</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('staff-license?staff_id=75') }}'><i class='nav-icon la la-question'></i> Licencias</a></li>
@else
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-institution"></i>Ingresantes</a>
        <ul class="nav-dropdown-items">
            <li class='nav-item'><a class='nav-link' href='{{ backpack_url('student?cycle_id=2&status=Inscripto') }}'><i class='nav-icon la la-mortar-board'></i> Inscriptos</a></li>
            <li class='nav-item'><a class='nav-link' href='{{ backpack_url('student?cycle_id=2&status=Aprobado') }}'><i class='nav-icon la la-mortar-board'></i> Aprobados</a></li>
            <li class='nav-item'><a class='nav-link' href='{{ backpack_url('student?cycle_id=2&status=Solicitado') }}'><i class='nav-icon la la-mortar-board'></i> Solicitantes</a></li>
            <li class='nav-item'><a class='nav-link' href='{{ backpack_url('student?cycle_id=2&status=Revision') }}'><i class='nav-icon la la-mortar-board'></i> En Revisión</a></li>
        </ul>
    </li>

    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-group"></i>Personal ISMP</a>
        <ul class="nav-dropdown-items">
            <li class='nav-item'><a class='nav-link' href='{{ backpack_url('staff') }}'><i class='nav-icon la la-question'></i> Personal</a></li>
            <li class='nav-item'><a class='nav-link' href='{{ backpack_url('license') }}'><i class='nav-icon la la-question'></i> Licencias</a></li>
            <li class='nav-item'><a class='nav-link' href='{{ backpack_url('discount') }}'><i class='nav-icon la la-question'></i> Descuentos</a></li>
        </ul>
    </li>

    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Plan de Estudio</a>
        <ul class="nav-dropdown-items">
            <li class='nav-item'><a class='nav-link' href='{{ backpack_url('study-plan') }}'><i class='nav-icon la la-question'></i> Planes de Estudio</a></li>
            <li class='nav-item'><a class='nav-link' href='{{ backpack_url('subject') }}'><i class='nav-icon la la-question'></i> Asignaturas</a></li>
            <li class='nav-item'><a class='nav-link' href='{{ backpack_url('correlative') }}'><i class='nav-icon la la-question'></i> Correlativas</a></li>
        </ul>
    </li>

    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Estudiantes</a>
        <ul class="nav-dropdown-items">
        {{--<li class='nav-item'><a class='nav-link' href='{{ backpack_url('student?effective=aspirantes') }}'><i class='nav-icon la la-user'></i> Aspirantes</a></li>--}}
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('student?status=Inscripto') }}'><i class='nav-icon la la-user-plus'></i> Estudiantes</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('sworn-declaration') }}'><i class='nav-icon la la-question'></i> DDJJ</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('regularity') }}'><i class='nav-icon la la-question'></i> Regularidades</a></li>
        </ul>
    </li>

    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-calendar"></i> Exámenes</a>
        <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('exam-shift?type=Turno-Examen') }}'><i class='nav-icon la la-clock'></i> Turnos</a></li>  
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('exam-table') }}'><i class='nav-icon la la-calendar'></i> Mesas</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('exam-inscriptions') }}'><i class='nav-icon la la-calendar'></i> Inscriptos</a></li>
        </ul>
    </li>

    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-calendar"></i> Tesorería</a>
        <ul class="nav-dropdown-items">
            <li class='nav-item'><a class='nav-link' href="{{ backpack_url('tariff-category') }}"><i class='nav-icon la la-question'></i> Categorías Arancelarias</a></li>
            <li class='nav-item'><a class='nav-link' href="{{ backpack_url('order') }}"><i class='nav-icon la la-question'></i> Órdenes de Pago</a></li>
            <li class='nav-item'><a class='nav-link' href="{{ backpack_url('metrics_orders') }}"><i class='nav-icon la la-question'></i> Metricas</a></li>
            <li class='nav-item'><a class='nav-link' href="{{ backpack_url('payment_coupon') }}"><i class='nav-icon la la-question'></i> BSE</a></li>
        </ul>
    </li>

    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-cog"></i>Configuración</a>
        <ul class="nav-dropdown-items">
            <li class='nav-item'><a class='nav-link' href='{{ backpack_url('career') }}'><i class='nav-icon la la-book'></i> Carreras</a></li>
            <li class='nav-item'><a class='nav-link' href='{{ backpack_url('cycle') }}'><i class='nav-icon la la-calendar-o'></i> Ciclos</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Usuarios</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        </ul>
    </li>
@endif

{{--<li class='nav-item'><a class='nav-link' href='{{ backpack_url('staff-license') }}'><i class='nav-icon la la-question'></i> Staff licenses</a></li>--}}