
@extends('layout.app')

@section('title', 'Dashboard')

<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>

@section('content')

    <div class = "overflow-hidden">
        <img class = "h-90 w-full object-cover"
        src = "{{ $propiedad -> primera_foto }}"
        alt = "Exterior de {{ $propiedad->nombre }}"
        >
        
        <div class = "p-6 md:p-8 bg-[#2C7474]">
            <h2 class = "text-4xl font-bold text-[#2E6C6F] text-white">{{ $propiedad -> nombre }}</h2>
            <p class = "mt-2 text-lg text-white">{{ $propiedad -> ubicacion }}</p> 

            <div class = "mt-6 pt-6 border-t border-white">
                <h3 class = "text-2xl font-semibold text-[#2E6C6F] text-white">Descripción</h3>
                <p class = "text-white mt-2 prose dark:prose-invert max-w-none">{{ $propiedad -> descripcion }}</p>
            </div>
            
            <ul class = "mt-4 grid grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-2">
                
                @foreach ($propiedad->amenidades as $amenidad)
                    <li class = "flex items-center text-white">
                        <i class = ""></i>
                        <span class = "ml-2">{{ $amenidad }}</span>
                    </li>
                @endforeach

            </ul>

            <div class = "mt-6 pt-6 border-t border-white">
                
                <h3 class = "text-2xl font-semibold text-[#2E6C6F] text-white">Galería de Fotos</h3>
                
                @foreach ($propiedad->fotos as $foto)
                    <div class = "mt-4 grid grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-2">
                        @foreach ($propiedad->fotos as $foto)
                            <x-image-modal
                                src = "{{ asset($foto) }}"
                                alt = "Foto de {{ $propiedad->nombre }}"
                            />
                        @endforeach
                    </div>
                @endforeach

            </div>

            <div x-data = "{ open: false }" class="relative">

                <!-- Botón para abrir modal -->
                <button 
                    @click="open = true; $nextTick(() => initCalendar())"
                    class = "px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500 transition"
                >
                    Abrir Modal
                </button>

                <!-- Modal -->
                <div 
                    x-show = "open" 
                    x-transition
                    class = "fixed inset-0 z-50 flex items-center justify-center bg-black/50"
                >
                    <div 
                        @click.away = "open = false"
                        class = "bg-white w-full max-w-lg mx-4 rounded-2xl shadow-xl p-6"
                    >
                        <h2 class = "text-xl font-bold text-gray-800 mb-4">
                            Título del Modal
                        </h2>

                        <p class="text-gray-600 mb-6">

                            <!-- Calendario -->
                            <div class = "bg-white rounded-lg w-full">
                                <h2 class = "text-lg font-bold ">Selecciona semanas</h2>
                                
                                <div class = "bg-white rounded-lg w-full p-2">
                                    <div id = "calendar" class = "w-full"></div>
                                    <div id = "selected-weeks" class = "mt-4 flex flex-wrap gap-2 text-gray-500 text-sm"></div>
                                </div>

                                <div class = "mt-6 flex justify-end gap-2">
                                    <button @click = "open = false" class = "px-4 py-2 bg-gray-300 rounded">Cerrar</button>
                                    <button id = "saveSelections" class = "px-10 py-3 bg-[#2C7474] text-white font-semibold rounded-xl shadow-lg hover:bg-[#265a5c] hover:scale-105 transition transform duration-300">Guardar semanas</button>
                                </div>
                            </div>
                            
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>
            
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script src="{{ asset('js/calendar.js') }}"></script>

    <link rel = "stylesheet" href = "{{ asset('css/calendar.css') }}">

    <script>
        const propertyId = {{ $propiedad->id }};
        const events = {!! $events !!}; 
        const takenWeeks = @json($takenWeeks ?? []);
    </script>
@endpush
