@extends('errors.layout')

@php
  $error_number = 403;
@endphp

@section('title')
Algo salio mal.
@endsection

@section('description')
  No te preocupes, intenta iniciar sesion haciendo <a href="login">click Aqui!!</a>
@endsection