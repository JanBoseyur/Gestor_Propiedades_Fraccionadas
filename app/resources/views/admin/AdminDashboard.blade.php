
@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

    <h2 class = "text-2xl font-bold my-5">Admin Dashboard</h2>

    <div class = "flex flex-block">

        <!-- Componente de Carta -->
        <x-stat-card
        title="Total de Propiedades"
        :value="128"
        color="bg-blue-500"
        >

            <x-slot:icon>
                <svg class = "w-5 h-5 text-white">...</svg>
            </x-slot:icon>

        </x-stat-card>

        <!-- Componente de Carta -->
        <x-stat-card
        title="Total de Socios"
        :value="128"
        color="bg-blue-500"
        >

            <x-slot:icon>
                <svg class = "w-5 h-5 text-white">...</svg>
            </x-slot:icon>

        </x-stat-card>

        <!-- Componente de Carta -->
        <x-stat-card
        title="Semanas Reservadas"
        :value="128"
        color="bg-blue-500"
        >

            <x-slot:icon>
                <svg class = "w-5 h-5 text-white">...</svg>
            </x-slot:icon>

        </x-stat-card>

        <!-- Componente de Carta -->
        <x-stat-card
        title="Ocupacion de Socios"
        :value="128"
        color="bg-blue-500"
        >

            <x-slot:icon>
                <svg class = "w-5 h-5 text-white">...</svg>
            </x-slot:icon>

        </x-stat-card>
    </div>

    <!-- Componente de Propiedades -->  
    <h2 class = "text-2xl font-bold my-5">Vista Rápida de Propiedades</h2>

    <!-- Controlar Separación y Posicionamiento --> 
    <div class = "grid grid-cols-3 gap-6">

        <!-- Componente Propiedades con Datos Dinamicos --> 
        @foreach ($propiedades as $propiedad)
            
            <a href = "{{ route('propiedades.show', $propiedad->id) }}">
                <x-property-card 
                    :title="$propiedad->nombre"
                    :background="$propiedad->imagen1"
                    :partners="$propiedad->n_socios"
                    :location="$propiedad->ubicacion"
                />
            </a>

        @endforeach
        
    </div>

@endsection