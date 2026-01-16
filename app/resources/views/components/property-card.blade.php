
<!-- Contenedor Carta Propiedades -->
<div class = "bg-[#F9F5F0] dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-1 hover:shadow-2xl transition-all duration-300 cursor-pointer">

    <!-- Fondo -->
    <div
        class = "h-56 w-full bg-cover bg-center"
        style = "background-image: url('{{ $background }}')">
    </div>

    <!-- Container Descripción -->
    <div class = "p-6">

        <h3 class = "text-2xl font-bold text-white">{{ $title }}</h3>

        <p class = "mt-2 text-md text-gray-600 dark:text-gray-400 flex items-center">
          
          <svg xmlns = "http://www.w3.org/2000/svg" class = "h-5 w-5 mr-2 text-[#D89C83]" viewBox = "0 0 20 20" fill = "currentColor">
            <path fillRule = "evenodd" d = "M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clipRule = "evenodd"/>
          </svg>

          {{ $location}}
        </p>

        <p class = "mt-2 text-sm text-white">
          {{ $partners }} / 8 socios
        </p>

    </div>

</div>