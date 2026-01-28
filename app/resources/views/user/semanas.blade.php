
@extends('layout.app')

@section('title', 'Mis semanas inscritas')

@section('content')
<div class="max-w-6xl mx-auto p-4 sm:p-6">

    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#2E6C6F] mb-8 text-center">
        Mis semanas inscritas
    </h2>

    @forelse($selections as $selection)
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 p-6 mb-6">

            <!-- Propiedad -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">
                        {{ $selection->propiedad->nombre }}
                    </h3>
                    <p class="text-sm text-gray-500">
                        {{ $selection->propiedad->ubicacion }}
                    </p>
                </div>

                <span class="px-4 py-1 rounded-full text-sm font-medium bg-[#2E6C6F]/10 text-[#2E6C6F]">
                    Año {{ $selection->anio }}
                </span>
            </div>

            <!-- Semanas -->
            <div>
                <p class="text-sm font-medium text-gray-600 mb-2">
                    Semanas inscritas
                </p>

                <div class="flex flex-wrap gap-2">
                    {{ dd($selections->first()->semana, gettype($selections->first()->semana)) }}
                </div>
            </div>

        </div>
    @empty
        <div class="text-center py-20 text-gray-500">
            No tienes semanas inscritas aún.
        </div>
    @endforelse

</div>
@endsection
