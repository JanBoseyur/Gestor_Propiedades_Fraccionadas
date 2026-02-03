
@extends('layout.app')

@section('title', 'Gestion de Propiedades')

@section('content')

<div class = "w-full min-h-screen bg-gray-50">

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
        class = "p-4 sm:p-6 lg:p-7"
    >
        <!-- GRID DE PROPIEDADES -->
        <div class = "grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            
            @foreach($propiedades as $prop)
                <x-property-card-admin 
                    :propiedad="$prop['propiedad']"
                    :socios="$prop['socios']"
                    :partners="$prop['partners']"
                    :title="$prop['title']"
                    :location="$prop['location']"
                    :background="$prop['background']"
                />
  
                <!-- Botón de editar que aparece al hacer hover -->
                <a href = "{{ route('propiedades.edit', $prop['propiedad']->id) }}" 
                class = "group-hover:opacity-100 bg-blue-500 text-white px-2 py-1 rounded shadow-sm text-xs sm:text-sm transition-opacity duration-200">
                    Editar
                </a>
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

