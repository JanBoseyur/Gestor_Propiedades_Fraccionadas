
@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

    <div class = "container mx-auto">
        
        <div class = "bg-[#F9F5F0] dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden mb-8">
            <img class = "h-64 w-full object-cover"
            src = "{{ $propiedad -> imagen1 }}"
            alt = "Exterior de {{ $propiedad->nombre }}"
            >
            
            <div class = "p-6 md:p-8">
                <h2 class = "text-4xl font-bold text-[#2E6C6F] dark:text-white">{{ $propiedad -> nombre }}</h2>
                <p class = "mt-2 text-lg text-gray-600 dark:text-gray-400">{{ $propiedad -> ubicacion }}</p> 

                <div class = "mt-6 pt-6 border-t border-[#F2E8DE] dark:border-gray-700">
                    <h3 class = "text-2xl font-semibold text-[#2E6C6F] dark:text-white">Descripción</h3>
                    <p class = "text-gray-700 dark:text-gray-300 mt-2 prose dark:prose-invert max-w-none">{{ $propiedad -> descripcion }}</p>
                </div>
            
            </div>
        </div>

        <div class = "grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class = "lg:col-span-2">
                <Calendar
                    year = {currentYear}
                    propertyId = {property.id}
                    selections = {selections}
                />
            </div>

            <div class = "bg-[#F9F5F0] dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class = "text-xl font-bold mb-4 text-[#2E6C6F] dark:text-white">Socios ({{ $propiedad -> n_socios }}/8)</h3>
                <ul class = "space-y-3">
                    <li key = {partner.id} class = "flex items-center p-2 bg-white dark:bg-gray-700 rounded-md">
                        <div class = "flex-shrink-0 h-8 w-8 rounded-full bg-[#B3D3D3] dark:bg-[#2E6C6F] text-[#2E6C6F] dark:text-[#B3D3D3] flex items-center justify-center font-bold">
                        </div>
                        <span class = "ml-3 font-medium text-gray-700 dark:text-gray-300">{{ $propiedad -> socios }}</span>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    

@endsection