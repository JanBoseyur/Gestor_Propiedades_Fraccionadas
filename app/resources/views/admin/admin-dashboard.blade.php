
@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

    <div class = "w-full min-h-screen bg-gray-50">
        <h2 class = "text-3xl font-extrabold text-[#2E6C6F] text-center mb-10">Dashboard de Administrador</h2>
        <p>Usuario: {{ auth()->user()->name }}</p>
<p>Rol: {{ auth()->user()->roles->pluck('name')->join(', ') }}</p>

    </div>

@endsection