
@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

    <div class = "flex ">
        
        <div class = "">
        <h2 class = "text-3xl font-bold text-[#2E6C6F] dark:text-black mb-8">Gestión de Socios</h2>
      
        <div class = "bg-[#F9F5F0] dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            <div class = "overflow-x-auto">
                <table class = "min-w-full text-left text-sm">
                <thead class = "border-b border-[#F2E8DE] dark:border-gray-700">
                <tr>
                    <th scope = "col" class = "px-6 py-4 font-medium text-[#2E6C6F] dark:text-gray-300">Nro. Identificación</th>
                    <th scope = "col" class = "px-6 py-4 font-medium text-[#2E6C6F] dark:text-gray-300">Nombre</th>
                    <th scope = "col" class = "px-6 py-4 font-medium text-[#2E6C6F] dark:text-gray-300">Email</th>
                    <th scope = "col" class = "px-6 py-4 font-medium text-[#2E6C6F] dark:text-gray-300">Ubicación</th>
                    <th scope = "col" class = "px-6 py-4 font-medium text-[#2E6C6F] dark:text-gray-300">Propiedades</th>
                    <th scope = "col" class = "px-6 py-4 font-medium text-[#2E6C6F] dark:text-gray-300">Acciones</th>
                </tr>
                </thead>
            <tbody>
                <tr key={partner.id} class = "border-b border-[#F2E8DE] dark:border-gray-700 hover:bg-[#F2E8DE] dark:hover:bg-gray-700/50 transition-colors">
                    <td class = "px-6 py-4 font-medium text-gray-800 dark:text-gray-200">{partner.partnerIdNumber}</td>
                    <td class = "px-6 py-4 font-medium text-gray-800 dark:text-gray-200">{partner.name}</td>
                    <td class = "px-6 py-4 text-gray-600 dark:text-gray-400">{partner.email}</td>
                    <td class = "px-6 py-4 text-gray-600 dark:text-gray-400">{partner.city}, {partner.country}</td>
                    <td class = "px-6 py-4 text-gray-600 dark:text-gray-400 text-center">{getPartnerPropertyCount(partner.id)}</td>
                    
                    <td class = "px-6 py-4 space-x-4">
                    
                    <button>
                        Editar
                    </button>
                    <button>
                        Eliminar
                    </button>
                    </td>

                </tr>
            </tbody>
          </table>
        </div>
        </div>

    </div>
@endsection