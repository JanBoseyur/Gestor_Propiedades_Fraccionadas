
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
          {{ $location}}
        </p>
        
        <div class = "mt-4 flex-grow">

          <p class = "font-semibold text-gray-700 dark:text-gray-300">
            {{ $partners }} / 8 socios
          </p>

          <ul class = "mt-2 space-y-2">
            <li key = {partner.id} class = "flex items-center justify-between bg-white dark:bg-gray-700 p-2 rounded-md">
              <span class = "text-gray-800 dark:text-gray-200">Hacer consulta de socios en BD</span>
              <button 
                class = "text-xs bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 transition-colors"
              >
                Eliminar
              </button>
            </li>
          </ul>

        </div>

    </div>

</div>