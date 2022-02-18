@extends('layouts.app')

@section('content')


    <h2>¡Hola jugador!</h2>
    <p>Para jugar, pulse <a href="{{route("acceder")}}" target="_blank">aqui</a></p>
    <p>Si no estas registrado, pulse <a href="{{route("registro")}}" target="_blank">aqui</a></p>

@endsection
