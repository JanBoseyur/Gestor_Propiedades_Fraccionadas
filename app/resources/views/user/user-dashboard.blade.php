
@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

    <div>
        <h2 class = "text-3xl font-extrabold text-[#2E6C6F] text-center mb-10">Dashboard de Usuario</h2>
    <div>

    <div class = "grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 justify-items-center text-center">
        Tarjetas
    </div>

    <!-- Controlar Separación y Posicionamiento --> 
    <div class = "mt-6">
        <p>{{ Auth::user()->name }}</p>
    </div>

@endsection