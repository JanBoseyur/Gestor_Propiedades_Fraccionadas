
<!-- Contenedor Carta Propiedades -->
<div class = "bg-[#2C7474] rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">

    <!-- Fondo -->
    <div
        class = "h-56 w-full bg-cover bg-center"
        style = "background-image: url('{{ $background }}')">
    </div>

    <!-- Container Descripción -->
    <div class = "p-6">

        <h3 class = "text-2xl font-bold text-white">{{ $title }}</h3>

        <p class = "mt-2 text-md text-white flex items-center">
          {{ $location}}
        </p>
        
        <div class = "mt-4 flex-grow">

          <p class = "font-semibold text-white">
            {{ $partners }} / 8 socios
          </p>

          <ul class = "mt-2 space-y-2">
            <li key = {partner.id} class = "flex items-center justify-between bg-white p-2 rounded-md">
              <span class = "font-bold text-[#2C7474]">Hacer consulta de socios en BD</span>
              
              <button 
                class = "text-xs bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 transition-colors cursor-pointer"
              >
                Eliminar
              </button>
              
            </li>
          </ul>

        </div>

    </div>

</div>