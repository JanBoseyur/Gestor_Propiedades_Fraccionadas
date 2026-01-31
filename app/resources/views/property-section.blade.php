
@extends('layout.app')

@section('title', 'Dashboard')

<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>

@section('content')

    <div class = "">
        
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

                <div x-data = "{ openCalendar: false, openConfirm: false }" class = "relative">

                    <div x-data = "{ openCalendar: false, openConfirm: false }">

                    <!-- BOTÓN ABRIR MODAL CALENDARIO -->
                    <button 
                        @click = "openCalendar = true; $nextTick(() => initCalendar())"
                        class = "px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500 transition"
                    >
                        Abrir Modal
                    </button>

                    <!-- MODAL CALENDARIO -->
                    <div
                        x-show = "openCalendar"
                        x-transition.opacity
                        class = "fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-5"
                        @click.self = "openCalendar = false"
                        x-init = "
                            $watch('openCalendar', value => {
                                if(value){
                                    $nextTick(() => {
                                        initCalendar();
                                        calendarInstance?.updateSize();
                                    })
                                }
                            })
                        "
                    >
                        <div class = "bg-white rounded-2xl shadow-xl p-4">

                            <h2 class = "text-lg font-bold mb-4">Selecciona semanas</h2>

                            <div class = "flex justify-center">
                                <div id = "calendar" class = "opacity-0 transition-opacity duration-200"></div>
                            </div>

                            <div class = "flex flex-row items-center justify-center mt-4 flex-wrap gap-2">

                                <div class = "flex justify-center items-center gap-3">
                                    <button 
                                        @click = "openCalendar = false"
                                        class = "flex justify-center items-center px-2 py-2 bg-gray-300 rounded-xl"
                                    >
                                        Cerrar
                                    </button>

                                    <button 
                                        @click = "openConfirm = true"
                                        class = "px-2 py-2 bg-[#2C7474] text-white rounded-xl"
                                    >
                                        Seleccionar
                                    </button>
                                </div>
                                
                            </div>

                        </div>
                    </div>

                    <!-- MODAL CONFIRMACIÓN -->
                    <div
                        x-show = "openConfirm"
                        x-transition.opacity
                        class = "fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-5"
                        @click.self = "openConfirm = false"
                    >
                        <div class = "bg-white rounded-2xl shadow-xl p-4">
                            <h2 class = "text-lg font-bold mb-4 text-center">Semanas Seleccionadas</h2>

                            <ul 
                                id = "selected-weeks" 
                                class = "list-disc list-inside space-y-2 text-sm text-gray-700 bg-gray-50 rounded-xl p-4 mb-4 text-center">
                            </ul>

                            <p class = "text-center text-sm text-gray-600 mb-6">
                                ¿Son correctas las selecciones?
                            </p>

                            <div class = "flex justify-center items-center gap-4">
                                <button 
                                    @click = "openConfirm = false"
                                    class = "px-4 py-2 rounded-xl bg-gray-200 text-gray-700 hover:bg-gray-300 transition"
                                >
                                    Cerrar
                                </button>

                                <button
                                    id = "saveSelections"
                                    @click = "openConfirm = false"
                                    class = "px-4 py-2 rounded-xl bg-[#2C7474] text-white hover:bg-[#245f5f] transition shadow-md"
                                >
                                    Confirmar
                                </button>
                            </div>

                        </div>
                    </div>

                </div>

                </div>

            </div>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.css">
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script src="{{ asset('js/calendar.js') }}"></script>

    <script>
        const propertyId = {{ $propiedad->id }};
        const events = {!! $events !!}; 
        const takenWeeks = @json($takenWeeks ?? []);
    </script>
@endpush
