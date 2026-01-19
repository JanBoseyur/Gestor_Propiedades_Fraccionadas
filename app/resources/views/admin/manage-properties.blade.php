
@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

    <!-- Componente Propiedades con Datos Dinamicos --> 
    <div class = "p-4 sm:p-6 lg:p-7 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Componente Propiedades con Datos Dinamicos --> 
        @foreach ($propiedades as $propiedad)
            
            <div href = "{{ route('propiedades.show', $propiedad->id) }}">
                <x-property-card-admin 
                    :title="$propiedad->nombre"
                    :background="$propiedad->imagen1"
                    :partners="$propiedad->n_socios"
                    :location="$propiedad->ubicacion"
                />
            </div>

        @endforeach
        
    </div>

@endsection