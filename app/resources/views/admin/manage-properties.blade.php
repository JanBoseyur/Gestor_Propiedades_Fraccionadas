
@extends('layout.app')

@section('title', 'Gestion de Propiedades')

@section('content')

<div class = "w-full min-h-screen rounded-tl-xl p-10 lg:p-0 lg:px-15">

    <!-- TÍTULO -->
    <div class = "">

        <h2 class = "text-4xl font-extrabold text-[#2C7474] tracking-tight">
            Gestión de Propiedades
        </h2>

        <p class = "mt-2 text-gray-500">
            Revisa y modifica toda la información de las propiedades y sus respectivos socios
        </p>
        
    </div>

    <a href = "{{ route('propiedades.create') }}">
        <button
            type = "button"
            class = "my-6 px-4 py-2 bg-[#2C7474] text-white font-semibold rounded-xl shadow-lg hover:bg-[#265a5c] hover:scale-105 transition transform duration-300 cursor-pointer"
        >
            Añadir Propiedad
        </button>
    </a>

    <!-- CONTENEDOR ALPINE GLOBAL -->
    <div x-data = "{
            showDeleteModal: false,
            propiedadId: null,
            usuarioId: null,
            usuarioName: '',

            openDeleteModal(data) {
                this.propiedadId = data.propiedadId
                this.usuarioId = data.usuarioId
                this.usuarioName = data.usuarioName
                this.showDeleteModal = true
            },

            closeDeleteModal() {
                this.showDeleteModal = false
                this.propiedadId = null
                this.usuarioId = null
                this.usuarioName = ''
            }
        }"
        x-on:open-delete-modal.window="openDeleteModal($event.detail)"
        class = ""
    >
        <!-- GRID DE PROPIEDADES -->
        <div class = "grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            
            @foreach($propiedades as $prop)

                <div class = "relative group inline-block">
                    <x-property-card-admin 
                        :propiedad="$prop['propiedad']"
                        :socios="$prop['socios']"
                        :partners="$prop['partners']"
                        :title="$prop['title']"
                        :location="$prop['location']"
                        :background="$prop['background']"
                    />
    
                    <a href = "{{ route('propiedades.edit', $prop['propiedad']->id) }}" 
                    class = "absolute top-2 right-2 sm:top-4 sm:right-4 
                            bg-[#2C7474] text-white px-2 sm:px-3 py-1 sm:py-2 
                            rounded shadow-sm text-xs sm:text-sm 
                            hover:opacity-90 transition-opacity duration-200 z-10">
                        Editar
                    </a>

                </div>
                
            @endforeach

        </div>

        <!-- MODAL ELIMINAR SOCIO -->
        <div
            x-show = "showDeleteModal"
            x-transition
            x-cloak
            class = "fixed inset-0 z-50 flex items-center justify-center bg-black/50"
        >
            <div
                @click.away = "closeDeleteModal()"
                class = "bg-white w-full mx-4 sm:mx-0 max-w-sm rounded-2xl shadow-xl p-6 text-center"
            >
                <h2 class = "text-xl font-bold mb-4">
                    ¿Eliminar socio?
                </h2>

                <p class = "text-gray-600 mb-6">
                    Confirma eliminar a <span class = "font-bold" x-text = "usuarioName"></span>
                </p>

                <form :action = "`/admin/propiedades/${propiedadId}/socios/${usuarioId}`" method = "POST">
                    @csrf
                    @method('DELETE')

                    <div class = "flex justify-center gap-4">
                        <button type = "button" @click = "closeDeleteModal()" class = "px-4 py-2 rounded text-gray-500 cursor-pointer">
                            Cancelar
                        </button>

                        <button type = "submit" class = "bg-red-600 text-white px-4 py-2 rounded hover:bg-red-500 cursor-pointer">
                            Eliminar
                        </button>
                    </div>
                    
                </form>
                
            </div>
        </div>
    </div>
</div>

@endsection

