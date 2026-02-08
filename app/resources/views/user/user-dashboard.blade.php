
@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

<div class = "w-full min-h-screen rounded-tl-xl px-10">

    <!-- TÍTULO -->
    <div class = "mb-8">

        <h2 class = "text-4xl font-extrabold text-[#2C7474] tracking-tight">
            ¡Bienvenido, {{ auth()->user()->name }}!
        </h2>

        <p class = "mt-2 text-gray-500">
            Mantén en orden toda tu información
        </p>

    </div>

    <div class = "w-full min-h-screen space-y-6">
        
        <div class = "grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">

            <!-- Total semanas -->
            <div class = "bg-white shadow-xl rounded-2xl p-5 flex items-center justify-between">
                
                <div>
                    <h3 class = "text-sm font-semibold uppercase text-gray-500">
                        Semanas reservadas
                    </h3>
                    <p class = "text-2xl font-bold text-gray-800 mt-2">
                        {{ $totalSemanas }}
                    </p>
                </div>

                <div class = "w-12 h-12 flex items-center justify-center rounded-xl bg-[#2C7474]/10">
                    <i class = "fa-solid fa-calendar-check text-[#2C7474] text-xl"></i>
                </div>

            </div>

            <!-- Propiedades -->
            <div class = "bg-white shadow-xl rounded-2xl p-5 flex items-center justify-between">
                
                <div>
                    <h3 class = "text-sm font-semibold uppercase text-gray-500">
                        Socio Propiedades
                    </h3>
                    <p class = "text-2xl font-bold text-gray-800 mt-2">
                        {{ $totalPropiedades }}
                    </p>
                </div>

                <div class = "w-12 h-12 flex items-center justify-center rounded-xl bg-[#2C7474]/10">
                    <i class = "fa-solid fa-house text-[#2C7474] text-xl"></i>
                </div>

            </div>

            <!-- Pagos pendientes -->
            <div class = "bg-white shadow-xl rounded-2xl p-5 flex items-center justify-between">
                
                <div>
                    <h3 class = "text-sm font-semibold uppercase text-gray-500">
                        Pagos pendientes
                    </h3>
                    <p class = "text-2xl font-bold text-gray-800 mt-2">
                        {{ $pagosPendientes }}
                    </p>
                </div>
                
                <div class = "w-12 h-12 flex items-center justify-center rounded-xl bg-[#2C7474]/10">
                    <i class = "fa-solid fa-clock text-[#2C7474] text-xl"></i>
                </div>

            </div>

            <!-- Pagos pagados -->
            <div class = "bg-white shadow-xl rounded-2xl p-5 flex items-center justify-between">
                
                <div>
                    <h3 class = "text-sm font-semibold uppercase text-gray-500">
                        Pagos realizados
                    </h3>
                    <p class = "text-2xl font-bold text-gray-800 mt-2">
                        {{ $pagosPagados }}
                    </p>
                </div>

                <div class = "w-12 h-12 flex items-center justify-center rounded-xl bg-[#2C7474]/10">
                    <i class = "fa-solid fa-circle-check text-[#2C7474] text-xl"></i>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection