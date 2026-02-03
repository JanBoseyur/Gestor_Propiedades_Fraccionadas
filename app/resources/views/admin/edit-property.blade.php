
@extends('layout.app')

@section('title', 'Editar Propiedad')

@section('content')
<div class="max-w-3xl mx-auto p-4 sm:p-6 bg-white rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Editar Propiedad</h2>

    <form action="{{ route('propiedades.update', $propiedad->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Nombre -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre', $propiedad->nombre) }}" 
                   class="w-full border-gray-300 rounded-lg p-2" required>
        </div>

        <!-- Ubicación -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Ubicación</label>
            <input type="text" name="ubicacion" value="{{ old('ubicacion', $propiedad->ubicacion) }}" 
                   class="w-full border-gray-300 rounded-lg p-2" required>
        </div>

        <!-- Descripción -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Descripción</label>
            <textarea name="descripcion" rows="3" 
                      class="w-full border-gray-300 rounded-lg p-2" required>{{ old('descripcion', $propiedad->descripcion) }}</textarea>
        </div>

        <!-- Fotos (JSON) -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Fotos (sube varias imágenes)</label>
            <input type="file" name="fotos[]" multiple class="w-full">
            
            @if($propiedad->fotos)
                <div class="mt-2 flex flex-wrap gap-2">
                    @php
                        $fotosArray = is_string($propiedad->fotos) ? json_decode($propiedad->fotos, true) : $propiedad->fotos;
                    @endphp
                    @foreach($fotosArray as $foto)
                        <img src="{{ $foto }}" class="w-24 h-16 object-cover rounded">
                    @endforeach
                </div>
            @endif
            
        </div>

        @php
            $amenidadesArray = [];
            if (is_string($propiedad->amenidades)) {
                $amenidadesArray = json_decode($propiedad->amenidades, true) ?? [];
            } elseif (is_array($propiedad->amenidades)) {
                $amenidadesArray = $propiedad->amenidades;
            }
        @endphp

        <!-- Amenidades (JSON) -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Amenidades (separadas por coma)</label>
            <input type="text" name="amenidades"
                value="{{ old('amenidades', implode(',', $amenidadesArray)) }}"
                class="w-full border-gray-300 rounded-lg p-2">
            <p class="text-xs text-gray-500 mt-1">Ejemplo: Piscina, Gimnasio, Estacionamiento</p>
        </div>

        <button type = "submit" 
                class = "bg-[#2E6C6F] text-white px-4 py-2 rounded-lg hover:bg-[#265a5b] transition-colors">
            Guardar Cambios
        </button>

    </form>
</div>
@endsection
