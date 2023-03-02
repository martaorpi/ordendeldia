<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .espe{
        background-color: #f6cbd1;
    }
</style>
<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> Inicio</a></li>


{{--<li class='nav-item'><a class='nav-link' href='{{ backpack_url('examenes') }}'><i class='nav-icon la la-question'></i> Examenes</a></li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-institution"></i>Ingresantes</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('student?cycle_id=2&status=Inscripto') }}'><i class='nav-icon la la-mortar-board'></i> Inscriptos</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('student?cycle_id=2&status=Aprobado') }}'><i class='nav-icon la la-mortar-board'></i> Aprobados</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('student?cycle_id=2&status=Solicitado') }}'><i class='nav-icon la la-mortar-board'></i> Solicitantes</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('student?cycle_id=2&status=Revision') }}'><i class='nav-icon la la-mortar-board'></i> En Revisión</a></li>
    </ul>
</li>--}}

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-cog"></i>Configuración</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Usuarios</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
    </ul>
</li>
