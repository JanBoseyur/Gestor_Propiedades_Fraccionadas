@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
<div class = "a">

    <!-- IMAGEN PRINCIPAL -->
    <div class = "relative w-full overflow-hidden">
        
        <img 
            class = "w-full h-96 md:h-[500px] object-cover" 
            src = "{{ $propiedad->primera_foto }}" 
            alt = "Exterior de {{ $propiedad->nombre }}"
        >

        <div class = "absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

        <div class = "absolute bottom-0 p-6 md:p-8 text-white">
            <h2 class = "text-3xl md:text-5xl font-bold">{{ $propiedad->nombre }}</h2>
            <p class = "mt-2 text-lg md:text-xl">{{ $propiedad->ubicacion }}</p>
        </div>

        <!-- MODALES -->
        <div 
            x-data = "{ openCalendar: false, openConfirm: false }"
            class = "absolute 
            
            bottom-78 right-4 
            md:bottom-8 md:right-8 z-10"
        >

            <!-- BOTÓN ABRIR CALENDARIO -->
            <button 
                @click = "openCalendar = true; $nextTick(() => initCalendar())"
                class = "px-6 py-3 bg-[#2C7474] text-white rounded-xl hover:bg-[#245f5f] transition shadow-md content-end cursor-pointer"
            >
                <i class = "fa-solid fa-calendar" style = "font-size: 24px;"></i>

            </button>

            <!-- MODAL CALENDARIO -->
            <div 
                x-show = "openCalendar"
                x-transition.opacity
                class = "fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
                @click.self = "openCalendar = false"
            >
                <div class = "bg-white rounded-2xl shadow-xl w-full max-w-2xl p-6 md:p-8">
                    <h2 class = "text-xl md:text-2xl font-bold text-center mb-4">Selecciona semanas</h2>
                    
                    <div class = "flex justify-center">
                        <div id = "calendar" class = "opacity-0 transition-opacity duration-200 w-full"></div>
                    </div>

                    <div class = "mt-6 flex justify-center gap-4 flex-wrap">
                        <button @click = "openCalendar = false" class = "px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition">Cerrar</button>
                        <button @click = "openConfirm = true" class = "px-4 py-2 bg-[#2C7474] text-white rounded-xl hover:bg-[#245f5f] transition">Seleccionar</button>
                    </div>
                
                </div>
            </div>

            <!-- MODAL CONFIRMACIÓN -->
            <div 
                x-show = "openConfirm"
                x-transition.opacity
                class = "fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
                @click.self = "openConfirm = false"
            >
                <div class = "bg-white rounded-2xl shadow-xl w-full max-w-md p-6 md:p-8">
                    <h2 class = "text-xl font-bold mb-4 text-center">Semanas Seleccionadas</h2>
                    <ul id = "selected-weeks" class = "list-disc list-inside space-y-2 text-gray-700 Rounded-xl p-4 mb-4 text-center"></ul>
                    <p class = "text-center text-sm text-gray-600 mb-6">¿Son correctas las selecciones?</p>
                    
                    <div class = "flex justify-center gap-4 flex-wrap">
                        <button @click = "openConfirm = false" class = "px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition">Cerrar</button>
                        <button id = "saveSelections" @click = "openConfirm = false" class = "px-4 py-2 bg-[#2C7474] text-white rounded-xl hover:bg-[#245f5f] transition shadow-md">Confirmar</button>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <!-- CONTENIDO -->
    <div class = "max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-4">

        <!-- DESCRIPCIÓN -->
        <section class = "
            bg-white
            rounded-2xl
            p-6 md:p-8
            shadow-sm
            border border-gray-100
        ">
            <h3 class = "text-2xl md:text-3xl font-semibold text-[#2C7474]">
                Descripción
            </h3>

            <p class = "text-gray-700 leading-relaxed whitespace-pre-line">
                {{ $propiedad->descripcion }}
            </p>

            <!-- AMENIDADES -->
            <h3 class = "text-2xl md:text-3xl font-semibold mt-8 mb-2 text-[#2C7474]">
                Amenidades
            </h3>

            <p class = "text-sm text-gray-600 mb-4 max-w-2xl">
                Esta propiedad cuenta con las siguientes amenidades:
            </p>

            <ul class = "flex flex-wrap gap-2 text-gray-700">
                @foreach ($propiedad->amenidades as $amenidad)
                    <li class="
                        flex items-center gap-2
                        px-3 py-1.5
                        rounded-full
                        bg-[#2C7474]/10
                        text-[#2C7474]
                        text-sm
                    ">
                        <i class="{{ amenidadIcon($amenidad) }} text-base md:text-lg"></i>
                        <span>{{ $amenidad }}</span>
                    </li>
                @endforeach
            </ul>

            <!-- GALERÍA CARRUSEL -->
            <section
                x-data = "{
                    activeImage: null,
                    open: false
                }"
                class = "overflow-hidden max-w-6xl mx-auto mt-10"
            >

                <!-- CARRUSEL -->
                <div class = "flex animate-carousel overflow-x-hidden">
                    
                    @foreach ($propiedad->fotos as $foto)
                        <div class = "w-1/2 sm:w-1/3 flex-shrink-0 p-2">
                            <img
                                src = "{{ $foto }}"
                                class = "w-full h-56 sm:h-64 object-cover rounded-2xl cursor-pointer transition-transform duration-300 hover:scale-110"
                                @click = "
                                    activeImage = '{{ $foto }}';
                                    open = true;
                                "
                            >
                        </div>
                    @endforeach

                    @foreach ($propiedad->fotos as $foto)
                        <div class = "w-1/2 sm:w-1/3 flex-shrink-0 p-2">
                            <img
                                src = "{{ $foto }}"
                                class = "w-full h-56 sm:h-64 object-cover rounded-2xl cursor-pointer transition-transform duration-300 hover:scale-105"
                                @click = "
                                    activeImage = '{{ $foto }}';
                                    open = true;
                                "
                            >
                        </div>
                    @endforeach
                </div>

                <!-- MODAL -->
                <template x-if = "open">
                    @include('components.image-modal')
                </template>
    </div> 
    
    <!-- Seccion Semanas -->
    <div class = "max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-4"> 

        <section class = "
            bg-white
            rounded-2xl
            p-6
            shadow-sm
            border border-gray-100">

            <h3 class = "text-2xl md:text-3xl font-semibold text-[#2C7474] mb-5">Calendario {{ now()->year }}</h3>

            <div id = "semanas-por-mes" class = ""
                data-url = "{{ route('propiedad.semanas.detalle', $propiedad->id) }}?anio={{ now()->year }}">
            </div>
        </section>
        
    </div>

</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.css">
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
@endpush

@push('scripts')
    <script src = "https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script src = "{{ asset('js/calendar.js') }}"></script>
    <script src = "{{ asset('js/semanas.js') }}"></script>
    <script>
        const propertyId = {{ $propiedad->id }};
        const takenWeeks = @json($takenWeeks ?? []);
    </script>
@endpush
