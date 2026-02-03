
<div
    x-show = "open"
    x-transition
    @keydown.escape.window = "open = false"
    class = "fixed inset-0 z-50 flex items-center justify-center"
>
    <!-- Fondo -->
    <div
        class = "absolute inset-0 bg-black/70"
        @click = "open = false"
    ></div>

    <!-- Imagen -->
    <div class = "relative z-50 max-w-4xl p-4">
        <img
            x-bind:src = "activeImage"
            alt = "Foto propiedad"
            class = "w-full max-h-[80vh] object-contain rounded-xl shadow-2xl"
        >
    </div>
</div>