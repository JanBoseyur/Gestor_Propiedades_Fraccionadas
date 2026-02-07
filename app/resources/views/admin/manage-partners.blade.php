
@extends('layout.app')

@section('title', 'Gestion de Socios')

@section('content')

<div class = "w-full min-h-screen rounded-tl-xl p-10 lg:p-0 lg:px-15">

    <!-- TÍTULO -->
    <div class = "mb-8">

        <h2 class = "text-4xl font-extrabold text-[#2C7474] tracking-tight">
            Gestión de Socios
        </h2>
        <p class = "mt-2 text-gray-500">
            Maneja y controla a los usuarios
        </p>
        
    </div>

    <div
        x-data="{
            showEdit: false,
            showDelete: false,
            user: {},

            openEdit(u) {
                this.user = u
                this.showEdit = true
            },

            openDelete(u) {
                this.user = u
                this.showDelete = true
            }
        }"
        
        class = ""
    >

        <!-- ================= TABLA (DESKTOP) ================= -->
        <div class = "hidden md:block bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 overflow-x-auto">

            <table class = "min-w-full text-sm text-gray-700">

                <thead class = "bg-[#2E6C6F] text-white">
                    
                    <tr>
                        <th class = "px-6 py-4 text-left">ID</th>
                        <th class = "px-6 py-4 text-left">Nombre</th>
                        <th class = "px-6 py-4 text-left">Email</th>
                        <th class = "px-6 py-4 text-center">Acciones</th>
                    </tr>

                </thead>

                <tbody class = "divide-y">
                    
                    @foreach ($users as $usuario)
                    <tr class = "hover:bg-[#F3FAFA] transition">

                        <td class = "px-6 py-4">{{ $usuario->id }}</td>
                        <td class = "px-6 py-4">{{ $usuario->name }}</td>
                        <td class = "px-6 py-4">{{ $usuario->email }}</td>

                        <td class = "px-6 py-4 text-center space-x-3">
                            <button
                                @click = 'openEdit(@json($usuario))'
                                class = "bg-blue-600 text-white px-4 py-2 rounded-xl hover:shadow-lg transition rounded-md hover:bg-blue-500 transitionr cursor-pointer"
                            >
                                Editar
                            </button>

                            <button
                                @click = 'openDelete(@json($usuario))'
                                class = "bg-red-600 text-white px-4 py-2 rounded-xl hover:shadow-lg transition rounded-md hover:bg-red-500 transition cursor-pointer"
                            >
                                Eliminar
                            </button>
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <!-- ================= CARDS (MÓVIL) ================= -->
        <div class = "md:hidden space-y-4">

            @foreach ($users as $usuario)
            <div class = "bg-white rounded-2xl shadow p-4">

                <div class = "flex justify-between items-start mb-3">
                    <div>
                        <p class = "text-xs text-gray-500">ID</p>
                        <p class = "font-semibold">{{ $usuario->id }}</p>
                    </div>

                    <div class = "flex gap-2">
                        <button
                            @click = 'openEdit(@json($usuario))'
                            class = "bg-blue-600 text-white px-3 py-1 rounded text-sm rounded-md hover:bg-blue-500 transition"
                        >
                            Editar
                        </button>

                        <button
                            @click = 'openDelete(@json($usuario))'
                            class = "bg-red-600 text-white px-3 py-1 rounded text-sm rounded-md hover:bg-red-500 transition"
                        >
                            Eliminar
                        </button>
                    </div>
                </div>

                <div class = "space-y-2">

                    <div>
                        <p class = "text-xs text-gray-500">Nombre</p>
                        <p class = "font-medium">{{ $usuario->name }}</p>
                    </div>

                    <div>
                        <p class = "text-xs text-gray-500">Email</p>
                        <p class = "break-all">{{ $usuario->email }}</p>
                    </div>
                    
                </div>

            </div>
            @endforeach

        </div>

        <!-- ================= MODAL EDITAR ================= -->
        <div
            x-show = "showEdit"
            x-transition
            class = "fixed inset-0 z-50 flex items-center justify-center bg-black/50"
        >
            <div
                @click.away = "showEdit = false"
                class = "bg-white w-full mx-4 sm:mx-0 max-w-md rounded-2xl shadow-xl p-6"
            >
                <h2 class = "text-2xl font-bold text-[#2E6C6F] mb-4">
                    Editar Usuario
                </h2>

                <form method="POST" :action="`/admin/users/${user.id}`">
                    @csrf
                    @method('PUT')

                    <div class = "mb-4">
                        <label class = "block text-sm font-medium mb-1">Nombre</label>
                        <input
                            type = "text"
                            name = "name"
                            x-model = "user.name"
                            class = "jidox-input w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#2E6C6F]"
                        >
                    </div>

                    <div class = "mb-4">
                        <label class = "block text-sm font-medium mb-1">Email</label>
                        <input
                            type = "email"
                            name = "email"
                            x-model = "user.email"
                            class = "w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#2E6C6F]"
                        >
                    </div>

                    <div class = "flex justify-end gap-3">
                        
                        <button type = "button" @click = "showEdit = false" class = "text-gray-500 cursor-pointer">
                            Cancelar
                        </button>

                        <button
                            type = "submit"
                            class = "bg-[#2E6C6F] text-white px-5 py-2 rounded-lg hover:bg-[#25585B] cursor-pointer"
                        >
                            Guardar
                        </button>

                    </div>
                </form>
            </div>
        </div>

        <!-- ================= MODAL ELIMINAR ================= -->
        <div
            x-show = "showDelete"
            x-transition
            class = "fixed inset-0 z-50 flex items-center justify-center bg-black/50"
        >
            <div
                @click.away = "showDelete = false"
                class = "bg-white w-full mx-4 sm:mx-0 max-w-sm rounded-2xl shadow-xl p-6 text-center"
            >
                <h2 class = "text-xl font-bold mb-4">
                    ¿Eliminar usuario?
                </h2>

                <p class = "text-gray-600 mb-6">
                    Esta acción no se puede deshacer
                </p>

                <form method = "POST" :action = "`/admin/users/${user.id}`">
                    @csrf
                    @method('DELETE')

                    <div class = "flex justify-center gap-4">
                        
                        <button class = "text-gray-500 cursor-pointer" type = "button" @click = "showDelete = false">
                            Cancelar
                        </button>

                        <button class = "bg-red-600 text-white px-4 py-2 rounded hover:bg-red-500 cursor-pointer">
                            Eliminar
                        </button>

                    </div>
                </form>
                
            </div>
        </div>
    </div>

</div>

@endsection
