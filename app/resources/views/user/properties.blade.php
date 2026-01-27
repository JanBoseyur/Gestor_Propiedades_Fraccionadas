
@extends('layout.app')

@section('title', 'Propiedades')

@section('content')

    <div class = "">

        @if($propiedades->isEmpty())
            <p>No hay propiedades registradas</p>
        
        @else

            <!-- Componente Propiedades con Datos Dinamicos --> 
            @foreach ($propiedades as $propiedad)
                <a href = "{{ route('propiedades.show', $propiedad->id) }}">
                    <x-property-card 
                        :title="$propiedad->nombre"
                        :background="$propiedad->primera_foto"
                        :partners="$propiedad->n_socios"
                        :location="$propiedad->ubicacion"
                    />
                </a>
            @endforeach

        @endif
        
    </div>
    

@endsection