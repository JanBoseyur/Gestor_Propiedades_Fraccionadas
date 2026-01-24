
<!-- Contenedor Carta Propiedades -->
<div class = "bg-[#2C7474] shadow-lg overflow-hidden transform hover:-translate-y-1 hover:shadow-2xl transition-all duration-300 cursor-pointer">

    <!-- Fondo -->
    <div
        class = "h-90 w-full bg-cover bg-center"
        style = "background-image: url('{{ $background }}')">
    </div>

    <!-- Container Descripción -->
    <div class = "p-6">

      <h3 class = "text-2xl font-bold text-white">{{ $title }}</h3>

      <p class = "mt-2 flex items-center text-sm text-white">
        <i class = "ri-map-pin-2-fill text-teal-200 mr-2"></i>
        {{ $location }}
      </p>

      <p class = "mt-2 text-ml text-white">
        {{ $partners }} / 8 socios
      </p>

    </div>

</div>