<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('cycle') }}'><i class='nav-icon la la-calendar-o'></i> Ciclos</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('carreras') }}'><i class='nav-icon la la-question'></i> Carreras</a></li>
{{--<li class='nav-item'><a class='nav-link' href='{{ backpack_url('examenes') }}'><i class='nav-icon la la-question'></i> Examenes</a></li>--}}
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('estudiantes') }}'><i class='nav-icon la la-mortar-board'></i> Estudiantes</a></li>
<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Personal ISMP</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Usuarios</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permisos</span></a></li>
    </ul>
</li>