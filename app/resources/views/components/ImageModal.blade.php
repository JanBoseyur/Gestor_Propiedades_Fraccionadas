
<div x-data = "{ open: false }">
    <!-- Imagen -->
    <img 
        src = "{{ $src }}" 
        alt = "Foto propiedad"
        class = "cursor-pointer rounded-lg shadow"
        @click = "open = true"
    >

    <!-- Modal -->
    <div 
        x-show = "open"
        x-transition
        @keydown.escape.window = "open = false"
        class = "fixed inset-0 z-50 flex items-center justify-center"
    >
        <!-- Fondo oscuro -->
        <div 
            class = "absolute inset-0 bg-black/70"
            @click = "open = false"
        ></div>

        <!-- Contenido -->
        <div class = "relative z-50 max-w-4xl w-full p-4">
            <img src = "{{ $src }}" alt = "{{ $alt }}"
            class = "w-full max-h-[80vh] object-contain rounded-lg shadow-2xl"
            >
        </div>
    </div>
</div>
