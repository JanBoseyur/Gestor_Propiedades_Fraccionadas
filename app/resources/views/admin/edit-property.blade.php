
@extends('layout.app')

@section('title', 'Editar Propiedad')

@section('content')

<div class = "min-h-screen flex flex-col items-center bg-gray-50 p-4 sm:p-6">

    <div class = "max-w-4xl sm:p-8 bg-white rounded-2xl shadow-lg">
        
        <h2 class = "text-3xl font-extrabold text-gray-800 mb-8 text-center sm:text-left">
            Editar Propiedad
        </h2>

        <form action = "{{ route('propiedades.update', $propiedad->id) }}" method = "POST" enctype = "multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div class = "flex flex-col">
                <label class = "text-gray-700 font-semibold mb-2">Nombre</label>
                <input type = "text" name = "nombre" value = "{{ old('nombre', $propiedad->nombre) }}"
                    class = "w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-[#2E6C6F] focus:border-transparent transition"
                    placeholder = "Nombre de la propiedad" required>
            </div>

            <!-- Ubicación -->
            <div class = "flex flex-col">
                <label class = "text-gray-700 font-semibold mb-2">Ubicación</label>
                <input type = "text" name = "ubicacion" value = "{{ old('ubicacion', $propiedad->ubicacion) }}"
                    class = "w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-[#2E6C6F] focus:border-transparent transition"
                    placeholder = "Ubicación de la propiedad" required>
            </div>

            <!-- Descripción -->
            <div class = "flex flex-col">
                <label class = "text-gray-700 font-semibold mb-2">Descripción</label>
                <textarea name = "descripcion" rows = "4"
                        class ="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-[#2E6C6F] focus:border-transparent transition"
                        placeholder = "Descripción detallada de la propiedad" required>{{ old('descripcion', $propiedad->descripcion) }}</textarea>
            </div>

            <!-- Fotos (JSON) -->
            <div class = "flex flex-col">
                <label class = "text-gray-700 font-semibold mb-2">Fotos (sube varias imágenes)</label>
                <input type = "file" name = "fotos[]" multiple class = "w-full border border-gray-300 rounded-xl p-2 cursor-pointer">

                @if($propiedad->fotos)
                    <div class = "mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @php
                            $fotosArray = is_string($propiedad->fotos) ? json_decode($propiedad->fotos, true) : $propiedad->fotos;
                        @endphp

                        @foreach($fotosArray as $foto)
                            <div class = "w-full h-32 overflow-hidden rounded-xl shadow-sm border border-gray-200">
                                <img src = "{{ $foto }}" alt = "Foto propiedad" class = "w-full h-full object-cover transform hover:scale-105 transition duration-300">
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
                <label class = "text-gray-700 font-semibold mb-2">Amenidades (separadas por coma)</label>
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
