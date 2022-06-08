<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> Inicio</a></li>


{{--<li class='nav-item'><a class='nav-link' href='{{ backpack_url('examenes') }}'><i class='nav-icon la la-question'></i> Examenes</a></li>--}}
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-institution"></i>Académico</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('student?status=Inscripto&cycle_id=1') }}'><i class='nav-icon la la-mortar-board'></i> Inscriptos</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('student?status=Aprobado&cycle_id=1') }}'><i class='nav-icon la la-mortar-board'></i> Aprobados</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('student?cycle_id=1&status=Solicitado') }}'><i class='nav-icon la la-mortar-board'></i> Solicitantes</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('student?cycle_id=1&status=Revision') }}'><i class='nav-icon la la-mortar-board'></i> En Revisión</a></li>
    </ul>
</li>
<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-group"></i>Personal ISMP</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Usuarios</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-cog"></i>Configuración</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('career') }}'><i class='nav-icon la la-book'></i> Carreras</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('cycle') }}'><i class='nav-icon la la-calendar-o'></i> Ciclos</a></li>
    </ul>
</li>


<li class='nav-item'><a class='nav-link' href='{{ backpack_url('subject') }}'><i class='nav-icon la la-question'></i> Asignaturas</a></li>
<!--<li class='nav-item'><a class='nav-link' href='{{ backpack_url('staff') }}'><i class='nav-icon la la-question'></i> Personal</a></li>-->