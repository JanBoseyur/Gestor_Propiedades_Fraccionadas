
@extends('layout.app')

@section('title', 'Editar Propiedad')

@section('content')

<div class = "w-full min-h-screen rounded-tl-xl p-10 lg:p-0 lg:px-15">

    {{-- TÍTULO --}}
    <div class = "mb-10 text-center md:text-left">
        
        <h2 class = "text-4xl font-extrabold text-[#2C7474] tracking-tight">
            Editar Propiedad
        </h2>

        <p class = "mt-2 text-gray-500">
            Modifica la información de la propiedad
        </p>
        
    </div>

    {{-- ALERTA --}}
    @if(session('success'))
        <div class = "mb-6 p-4 rounded-xl bg-green-50 text-green-700 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

        <form action = "{{ route('propiedades.update', $propiedad->id) }}" method = "POST" enctype = "multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div class = "flex flex-col">
                <label class = "text-[#2C7474] font-semibold mb-2">Nombre</label>
                <input type = "text" name = "nombre" value = "{{ old('nombre', $propiedad->nombre) }}"
                    class = "w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-[#2E6C6F] focus:border-transparent transition"
                    placeholder = "Nombre de la propiedad" required>
            </div>

            <!-- Ubicación -->
            <div class = "flex flex-col">
                <label class = "text-[#2C7474] font-semibold mb-2">Ubicación</label>
                <input type = "text" name = "ubicacion" value = "{{ old('ubicacion', $propiedad->ubicacion) }}"
                    class = "w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-[#2E6C6F] focus:border-transparent transition"
                    placeholder = "Ubicación de la propiedad" required>
            </div>

            <!-- Descripción -->
            <div class = "flex flex-col">
                <label class = "text-[#2C7474] font-semibold mb-2">Descripción</label>
                <textarea name = "descripcion" rows = "4"
                        class = "w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-[#2E6C6F] focus:border-transparent transition"
                        placeholder = "Descripción detallada de la propiedad" required>{{ old('descripcion', $propiedad->descripcion) }}</textarea>
            </div>

            <!-- Fotos (JSON) -->
            <div class = "flex flex-col">
                <label class = "text-[#2C7474] font-semibold mb-2">Fotos</label>

                <!-- Input con icono -->
                <label class = "flex items-center gap-2 w-full border border-gray-300 rounded-xl p-3 cursor-pointer hover:bg-gray-50 transition">
                    
                    <!-- Icono de cámara -->
                    <i class = "fa-solid fa-camera text-[#2C7474] text-lg flex-shrink-0"></i>

                    <span class = "text-gray-500 text-sm">Selecciona imágenes...</span>
                    <input type = "file" name = "fotos[]" multiple accept = ".jpg,.jpeg,.png" class = "hidden">
                </label>

                <!-- Previsualización de fotos -->
                @if($propiedad->fotos)
                    <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @php
                            $fotosArray = is_string($propiedad->fotos) ? json_decode($propiedad->fotos, true) : $propiedad->fotos;
                        @endphp

                        @foreach($fotosArray as $foto)
                            <div class="w-full h-32 overflow-hidden rounded-xl shadow-sm border border-gray-200">
                                <img src="{{ $foto }}" alt="Foto propiedad" class="w-full h-full object-cover transform hover:scale-105 transition duration-300">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Amenidades (JSON) -->
            @php
                $amenidadesArray = [];
                if (is_string($propiedad->amenidades)) {
                    $amenidadesArray = json_decode($propiedad->amenidades, true) ?? [];
                } elseif (is_array($propiedad->amenidades)) {
                    $amenidadesArray = $propiedad->amenidades;
                }
            @endphp

            <div class = "flex flex-col">
                <label class = "text-[#2C7474] font-semibold mb-2">Amenidades</label>
                <input type = "text" name = "amenidades"
                    value = "{{ old('amenidades', implode(',', $amenidadesArray)) }}"
                    class = "w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-[#2E6C6F] focus:border-transparent transition"
                    placeholder = "Piscina, Gimnasio, Estacionamiento">
                <p class = "text-xs text-gray-500 mt-1">Ejemplo: Piscina, Gimnasio, Estacionamiento</p>
            </div>

            <!-- Botón Guardar -->
            <div class = "flex justify-end">
                <button type = "submit"
                        class = "bg-[#2E6C6F] text-white font-semibold px-6 py-3 rounded-xl shadow hover:bg-[#265a5b] transition-colors duration-300">
                    Guardar Cambios
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
