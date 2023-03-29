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

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('doc') }}"><i class="nav-icon la la-book"></i> Boletines</a></li>

{{--<li class="nav-item"><a class="nav-link" href="{{ backpack_url('doc/example') }}"><i class="nav-icon la la-question"></i> Inicio alternativo</a></li>--}}

@if(backpack_user()->hasRole('admin'))
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-cog"></i>Configuración</a>
        <ul class="nav-dropdown-items">
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Usuarios</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        </ul>
    </li>
@endif

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('view-user') }}'><i class='nav-icon la la-question'></i> View users</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('digesto') }}'><i class='nav-icon la la-question'></i> Digesto</a></li>
