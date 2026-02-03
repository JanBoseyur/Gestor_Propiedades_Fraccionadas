@extends('layout.app')

@section('title', 'Mis semanas')

@section('content')

<div class = "min-h-screen max-w-screen flex flex-col items-center justify-start bg-gray-50 p-4 sm:p-6">

    <h2 class = "text-2xl sm:text-3xl font-extrabold text-[#2E6C6F] mb-8 text-center">
        Mis semanas inscritas
    </h2>

    @forelse($selecciones as $seleccion)
        <div class = "bg-white rounded-2xl shadow-md ring-1 ring-gray-200 p-4 sm:p-6 mb-6 hover:shadow-lg transition-shadow duration-300">

            <!-- Propiedad -->
            <div class = "sm:flex-row sm:items-center sm:justify-between">
                
                <div class = "mb-4">
                    <span class = "px-2 py-1 rounded-full text-sm sm:text-base font-medium bg-[#2E6C6F]/20 text-[#2E6C6F]">
                        Año {{ $seleccion->anio }}
                    </span>
                </div>

                <div>
                    <h3 class = "text-base sm:text-lg font-bold text-gray-800">
                        {{ $seleccion->propiedad->nombre }}
                    </h3>

                    <p class = "text-xs sm:text-sm text-gray-500">
                        {{ $seleccion->propiedad->ubicacion }}
                    </p>
                </div>

            </div>

            <!-- Semanas -->
            <div>
                <p class = "text-sm sm:text-base font-medium text-gray-600 my-4">
                    Semanas inscritas
                </p>

                <div class = "flex flex-wrap sm:flex-row gap-2 ">
                    
                    @foreach ($seleccion->semanasFechas as $semana)
                        
                        <span class = "flex-none px-3 py-1 bg-[#E0F2F1] rounded-full text-xs md:text-base whitespace-nowrap shadow-sm hover:scale-105 transform transition-all duration-200">
                            Semana {{ $semana['numero'] }}: {{ $semana['inicio'] }} - {{ $semana['fin'] }}
                        </span>

                    @endforeach

                </div>
            </div>

        </div>
    
    @empty
        <div class = "text-center py-20 text-gray-500">
            No tienes semanas inscritas aún.
        </div>
    @endforelse

</div>
@endsection
