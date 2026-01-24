
@props([
    'propiedad',
    'socios',
    'partners',
    'title',
    'location',
    'background'
])

<!-- Contenedor Carta Propiedades -->
<div class = "bg-gradient-to-br from-[#2C7474] to-[#1E5F61] rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">

    <!-- Imagen -->
    <div class = "h-56 w-full bg-cover bg-center relative">
        <div class = "absolute inset-0 bg-black/25"></div>
        <div class = "absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $background }}')"></div>
    </div>

    <!-- Contenido -->
    <div class = "p-6 space-y-4">

        <!-- Título -->
        <h3 class = "text-2xl font-bold text-white tracking-wide">{{ $title }}</h3>

        <!-- Ubicación -->
        <p class = "text-sm text-teal-100 flex items-center gap-1">
            <i class = "ri-map-pin-2-fill text-teal-200"></i>
            {{ $location }}
        </p>

        <!-- Contador -->
        <p class = "font-semibold text-teal-100">
            {{ $partners }} / 8 socios
        </p>

        <!-- Lista de socios -->
        <ul class = "space-y-2 pt-2">

            @forelse ($socios as $usuario)
                <li class = "flex items-center justify-between bg-white/90 px-3 py-2 rounded-lg shadow-sm">

                    <span class = "font-medium text-[#2C7474]">{{ $usuario->name }}</span>

                    <button
                        @click = "$dispatch('open-delete-modal', { propiedadId: {{ $propiedad->id }}, usuarioId: {{ $usuario->id }}, usuarioName: '{{ $usuario->name }}' })"
                        class = "text-xs bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-500 transition cursor-pointer"
                    >
                        Eliminar
                    </button>

                </li>
            
                @empty
                <li class = "text-sm text-teal-100 italic">No hay socios registrados</li>
            @endforelse

        </ul>

    </div>
</div>
