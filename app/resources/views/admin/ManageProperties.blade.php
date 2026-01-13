
@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

    <!-- Componente Propiedades con Datos Dinamicos --> 
    <div class = "grid grid-cols-3 gap-6">

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