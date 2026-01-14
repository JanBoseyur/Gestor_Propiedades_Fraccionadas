@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

    <div class = "">
        
    <h2 class = "text-3xl font-bold text-black mb-8">
            Gestión de Gasto Común
        </h2>

        <div class = "mb-8 p-4 bg-[#F9F5F0] dark:bg-gray-800 rounded-lg shadow-md">
            <h3 class = "text-xl font-semibold text-[#2E6C6F] dark:text-white mb-2">
                Generar Cobros Mensuales
            </h3>

            <p class = "text-sm text-gray-600 dark:text-gray-400 mb-4">
                Esta acción generará los cobros según el gasto común configurado en cada propiedad.
            </p>

            <form action = "" method = "POST" class = "flex flex-wrap items-end gap-4">

                <div>
                    <label class = "block text-sm font-medium">Año</label>
                    <select name = "year" class = "mt-1 w-full rounded-md">
                            <option value = ""></option>
                    </select>
                </div>

                <div>
                    <label class = "block text-sm font-medium">Mes</label>
                    <select name = "month" class = "mt-1 w-full rounded-md">
                            <option value = ""></option>
                    </select>
                </div>

                <button class = "px-6 py-2 bg-[#2E6C6F] text-white rounded-lg">
                    Generar Cobros
                </button>
            </form>
        </div>

        <div class = "grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
            
            <div class = "p-4 rounded-lg bg-[#2E6C6F] text-white shadow">
                <h4>Total Recaudado</h4>
                <p class="text-2xl font-bold">
                </p>
            </div>

            <div class = "p-4 rounded-lg bg-[#D89C83] text-white shadow">
                <h4>Total Pendiente</h4>
                <p class = "text-2xl font-bold">
                </p>
            </div>

        </div>

        <div class = "bg-[#F9F5F0] dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            
            <div class = "overflow-x-auto">
                
                <table class = "min-w-full text-sm">
                    
                    <thead>
                        <tr class = "border-b">
                            <th class = "px-6 py-4">Propiedad</th>
                            <th class = "px-6 py-4">Socio</th>
                            <th class = "px-6 py-4">Periodo</th>
                            <th class = "px-6 py-4">Monto</th>
                            <th class = "px-6 py-4">Estado</th>
                            <th class = "px-6 py-4">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                            <tr class = "border-b hover:bg-gray-100">
                                <td class = "px-6 py-4"></td>
                                <td class = "px-6 py-4"></td>
                                <td class = "px-6 py-4"></td>
                                <td class = "px-6 py-4"></td>
                                
                                <td class = "px-6 py-4">
                                    <span class = "px-2 py-1 rounded-full text-xs">
                                    </span>
                                </td>

                                <td class = "px-6 py-4">
                                        <form action = "" method = "POST">
                                            <button class = "text-[#2E6C6F] hover:underline">
                                                Marcar como Pagado
                                            </button>
                                        </form>
                                </td>
                            </tr>

                            <tr>
                                <td colspan = "6" class = "text-center py-10">
                                    No hay pagos registrados
                                </td>
                            </tr>
                            
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection