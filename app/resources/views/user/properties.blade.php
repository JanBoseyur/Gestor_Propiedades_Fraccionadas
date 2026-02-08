
@extends('layout.app')

@section('title', 'Propiedades')

@section('hideHeader')
@endsection

@section('content')

    <div class = "w-full min-h-screen">

        @if($propiedades->isEmpty())
            <p>No hay propiedades registradas</p>
        
        @else

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