
@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

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

    class = "p-6 max-w-7xl mx-auto"
>

    <h2 class = "text-3xl font-extrabold text-[#2E6C6F] text-center mb-10">
        Gestión de Socios
    </h2>

    <div class = "bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 overflow-x-auto">

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
                            class = "bg-blue-600 text-white px-4 py-2 rounded-xl cursor-pointer transform hover:-translate-y-1 hover:shadow-2xl transition-all duration-400">
                            Editar
                        </button>

                        <button
                            @click = 'openDelete(@json($usuario))'
                            class = "bg-red-600 text-white px-4 py-2 rounded-xl cursor-pointer transform hover:-translate-y-1 hover:shadow-2xl transition-all duration-400">
                            Eliminar
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <!-- MODAL EDITAR -->
    <div
        x-show="showEdit"
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    >
        <div
            @click.away="showEdit = false"
            class="bg-white w-full max-w-md rounded-2xl shadow-xl p-6"
        >
            <h2 class="text-2xl font-bold text-[#2E6C6F] mb-4">
                Editar Usuario
            </h2>

            <form method="POST" :action="`/admin/users/${user.id}`">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Nombre</label>
                    <input
                        type="text"
                        name="name"
                        x-model="user.name"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#2E6C6F]"
                    >
                </div>

                <div class = "mb-4">
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input
                        type = "email"
                        name = "email"
                        x-model = "user.email"
                        class = "w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#2E6C6F]"
                    >
                </div>

                <div class = "flex justify-end gap-3">
                    <button type = "button" @click="showEdit = false" class="text-gray-500">
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

    <!-- MODAL ELIMINAR -->
    <div
        x-show="showDelete"
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    >
        <div
            @click.away = "showDelete = false"
            class = "bg-white w-full max-w-sm rounded-2xl shadow-xl p-6 text-center"
        >
            <h2 class="text-xl font-bold mb-4">
                ¿Eliminar usuario?
            </h2>

            <p class = "text-gray-600 mb-6">
                Esta acción no se puede deshacer
            </p>

            <form method="POST" :action="`/admin/users/${user.id}`">
                @csrf
                @method('DELETE')

                <div class="flex justify-center gap-4">
                    
                    <button class = "" type = "button" @click="showDelete = false">
                        Cancelar
                    </button>

                    <button class = "bg-red-600 text-white px-4 py-2 rounded cursor-pointer">
                        Eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
