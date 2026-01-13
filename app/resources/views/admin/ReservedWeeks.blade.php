
@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

    <div class="container mx-auto">

    <h2 class="text-3xl font-bold text-[#2E6C6F] dark:text-black mb-8">
        Semanas Reservadas
    </h2>

    <!-- Filtros -->
    <form method="GET" class="flex flex-wrap gap-4 mb-6 p-4 bg-[#F9F5F0] dark:bg-gray-800 rounded-lg shadow-md">

        <!-- Filtro Año -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Filtrar por Año
            </label>
            <select name="year"
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 shadow-sm">
                    <option>
                    </option>
            </select>
        </div>

        <!-- Filtro Propiedad -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Filtrar por Propiedad
            </label>
            <select name="propiedad"
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 shadow-sm">
                <option value="">Todas las Propiedades</option>
                    <option>
                    </option>
            </select>
        </div>

        <div class="flex items-end">
            <button class="px-4 py-2 bg-[#2E6C6F] text-white rounded-md">
                Filtrar
            </button>
        </div>

    </form>

    <!-- Tabla -->
    <div class="bg-[#F9F5F0] dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">

            <table class="min-w-full text-left text-sm">
                <thead class="border-b border-[#F2E8DE] dark:border-gray-700">
                    <tr>
                        <th class="px-6 py-4">Propiedad</th>
                        <th class="px-6 py-4">Socio</th>
                        <th class="px-6 py-4">Año</th>
                        <th class="px-6 py-4">Semanas Reservadas</th>
                    </tr>
                </thead>

                <tbody>
                        <tr class="border-b hover:bg-[#F2E8DE] dark:hover:bg-gray-700/50">
                            <td class="px-6 py-4 font-medium">
                                a
                            </td>
                            <td class="px-6 py-4">
                                a
                            </td>
                            <td class="px-6 py-4">
                                a
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                        <span class="px-2 py-1 bg-[#B3D3D3] text-[#2E6C6F] text-xs font-medium rounded-full">
                                        </span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-center py-16">
                                <h3 class="text-xl font-semibold">
                                    No hay Reservas
                                </h3>
                                <p class="text-gray-500 mt-2">
                                    No se encontraron semanas reservadas con los filtros seleccionados.
                                </p>
                            </td>
                        </tr>
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection