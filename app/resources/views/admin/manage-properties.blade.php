
@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

    <!-- Componente Propiedades con Datos Dinamicos --> 
    @foreach ($propiedades as $propiedad)
        <div class="mb-4">
            <h3 class="font-bold">{{ $propiedad->nombre }}</h3>

            <p class="text-sm text-gray-600">Socios:</p>

            @if ($propiedad->socios->isEmpty())
                <span class="text-xs text-gray-400">Sin socios</span>
            @else
                <ul class="list-disc ml-4">
                    @foreach ($propiedad->socios as $socio)
                        <li>{{ $socio->name }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endforeach


@endsection