
@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

    <div>
        <h2 class = "text-3xl font-extrabold text-[#2E6C6F] text-center mb-10">Dashboard de Administrador</h2>
    <div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 justify-items-center text-center">

        <x-stat-card
            title="Total de Propiedades"
            :value="$totalPropiedades"
            icon="ri-building-2-fill"
        />

        <x-stat-card
            title="Total de Socios"
            :value="128"
            icon="ri-group-2-fill"
        />

        <x-stat-card
            title="Semanas Reservadas"
            :value="128"
            icon="ri-calendar-check-fill"
        />

        <x-stat-card
            title="Ocupación de Socios"
            :value="128"
            icon="ri-percent-fill"
        />

    </div>

    <!-- Controlar Separación y Posicionamiento --> 
    <div class = "mt-6">

        @if($propiedades->isEmpty())
            <p>No hay propiedades registradas</p>
        
        @else
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
        @endif
        
    </div>

@endsection