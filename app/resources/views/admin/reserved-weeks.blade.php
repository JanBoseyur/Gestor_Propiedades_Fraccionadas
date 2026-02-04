
@extends('layout.app')

@section('title', 'Semanas Reservadas')

@section('content')

<div class = "w-full min-h-screen bg-white p-6">

    <div class = "">

        {{-- TÍTULO --}}
        <div class = "mb-10 text-center md:text-left">
            <h2 class = "text-4xl font-extrabold text-[#2C7474] tracking-tight">
                Semanas Reservadas por Propiedad
            </h2>
            <p class = "mt-2 text-gray-500">
                Revisa las últimas reservaciones en cada propiedad
            </p>
        </div>

    <!-- ================= FILTROS ================= -->
    <form method = "GET"
        class = "bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 p-4 sm:p-6 mb-8 flex flex-wrap gap-6">

        <div>
            <label class = "block text-sm font-medium mb-1">Filtrar por Año</label>
            <select name = "anio"
                class = "rounded-lg border-gray-300 focus:ring-2 focus:ring-[#2E6C6F]">
                <option value="">Todos</option>
                
                @foreach ($anios as $anio)
                    <option value="{{ $anio->anio }}"
                        @selected($anioFiltro == $anio->anio)>
                        {{ $anio->anio }}
                    </option>
                @endforeach

            </select>
        </div>

        <div>
            <label class = "block text-sm font-medium mb-1">Filtrar por Propiedad</label>
            <select name = "propiedad"
                class = "rounded-lg border-gray-300 focus:ring-2 focus:ring-[#2E6C6F]">
                <option value="">Todas</option>
                
                @foreach ($propiedades as $prop)
                    <option value = "{{ $prop->id }}"
                        @selected($propiedadFiltro == $prop->id)>
                        {{ $prop->nombre }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class = "flex items-end">
            <button
                class = "bg-[#2E6C6F] text-white px-6 py-2 rounded-lg hover:bg-[#25585B] transition cursor-pointer">
                Filtrar
            </button>
        </div>

    </form>

    <!-- ================= TABLA DESKTOP ================= -->
    <div class = "hidden md:block bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 overflow-x-auto">

        <table class = "min-w-full text-sm text-gray-700">

            <thead class = "bg-[#2E6C6F] text-white">
                <tr>
                    <th class = "px-6 py-4 text-left">Propiedad</th>
                    <th class = "px-6 py-4 text-left">Socio</th>
                    <th class = "px-6 py-4 text-left">Año</th>
                    <th class = "px-6 py-4 text-left">Semanas Reservadas</th>
                </tr>
            </thead>

            <tbody class = "divide-y">

                @forelse ($reservas as $reserva)
                <tr class = "hover:bg-[#F3FAFA] transition">

                    <td class = "px-6 py-4 font-medium">
                        {{ $reserva['propiedad'] }}
                    </td>

                    <td class = "px-6 py-4">
                        {{ $reserva['usuario'] }}
                    </td>

                    <td class = "px-6 py-4">
                        {{ $reserva['anio'] }}
                    </td>

                    <td class = "px-6 py-4">
                        <div class = "flex flex-wrap gap-2">
                            
                            @foreach ($reserva['semanas'] as $semana)
                                @php
                                    $inicio = \Carbon\Carbon::now()
                                        ->setISODate($reserva['anio'], $semana)
                                        ->startOfWeek()
                                        ->format('d/m');

                                    $fin = \Carbon\Carbon::now()
                                        ->setISODate($reserva['anio'], $semana)
                                        ->endOfWeek()
                                        ->format('d/m');
                                @endphp

                                <span
                                    class = "px-3 py-1 bg-[#B3D3D3] text-[#2E6C6F] text-xs rounded-full font-medium">
                                    S{{ $semana }} ({{ $inicio }} - {{ $fin }})
                                </span>

                            @endforeach
                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan = "4" class = "text-center py-16 text-gray-500">
                        No hay reservas con los filtros seleccionados
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    <!-- ================= CARDS MÓVIL ================= -->
    <div class = "md:hidden space-y-4">

        @forelse ($reservas as $reserva)
        <div class = "bg-white rounded-2xl shadow p-4 space-y-3">

            <div>
                <p class = "text-xs text-gray-500">Propiedad</p>
                <p class = "font-medium">{{ $reserva['propiedad'] }}</p>
            </div>

            <div>
                <p class = "text-xs text-gray-500">Socio</p>
                <p>{{ $reserva['usuario'] }}</p>
            </div>

            <div>
                <p class = "text-xs text-gray-500">Año</p>
                <p>{{ $reserva['anio'] }}</p>
            </div>

            <div>
                <p class = "text-xs text-gray-500 mb-1">Semanas</p>
                <div class = "flex flex-wrap gap-2">
                    
                    @foreach ($reserva['semanas'] as $semana)
                        @php
                            $inicio = \Carbon\Carbon::now()
                                ->setISODate($reserva['anio'], $semana)
                                ->startOfWeek()
                                ->format('d/m');

                            $fin = \Carbon\Carbon::now()
                                ->setISODate($reserva['anio'], $semana)
                                ->endOfWeek()
                                ->format('d/m');
                        @endphp

                        <span
                            class = "px-3 py-1 bg-[#B3D3D3] text-[#2E6C6F] text-xs rounded-full">
                            S{{ $semana }} ({{ $inicio }} - {{ $fin }})
                        </span>
                    @endforeach

                </div>
            </div>

        </div>

        @empty
        <div class = "text-center py-16 text-gray-500">
            No hay reservas con los filtros seleccionados
        </div>
        @endforelse

    </div>

</div>

@endsection
