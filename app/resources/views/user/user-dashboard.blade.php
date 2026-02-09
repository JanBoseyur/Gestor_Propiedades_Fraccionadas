
@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

<div class = "w-full rounded-tl-xl">

    <!-- TÍTULO -->
    <div class = "mb-8 px-10">

        <h2 class = "text-4xl font-extrabold text-[#2C7474] tracking-tight">
            ¡Bienvenido, {{ auth()->user()->name }}!
        </h2>

        <p class = "mt-2 text-gray-500">
            Mantén en orden toda tu información
        </p>

    </div>

    <div class = "w-full space-y-3">
        
        <div class = "grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 px-10">

            <!-- Total semanas -->
            <div class = "flex bg-white shadow-xl rounded-2xl p-5 border-l-4 border-[#2C7474] items-center justify-between ">
                
                <div>
                    <h3 class = "text-xs font-semibold uppercase text-gray-500">
                        Semanas reservadas
                    </h3>
                    <p class = "text-2xl font-bold text-gray-800 mt-2">
                        {{ $totalSemanas }}
                    </p>
                    <p class = "text-xs text-gray-400 mt-1">Este año</p>
                </div>

                <div class = "w-12 h-12 flex items-center justify-center rounded-xl bg-[#2C7474]/10">
                    <i class = "fa-solid fa-calendar-check text-[#2C7474] text-xl"></i>
                </div>

            </div>

            <!-- Propiedades -->
            <div class = "flex bg-white shadow-xl rounded-2xl p-5 border-l-4 border-[#2C7474] items-center justify-between ">
                
                <div>
                    <h3 class = "text-xs font-semibold uppercase text-gray-500">
                        Socio
                    </h3>
                    <p class = "text-2xl font-bold text-gray-800 mt-2">
                        {{ $totalPropiedades }}
                    </p>
                    <p class = "text-xs text-gray-400 mt-1">En propiedades</p>
                </div>

                <div class = "w-12 h-12 flex items-center justify-center rounded-xl bg-[#2C7474]/10">
                    <i class = "fa-solid fa-house text-[#2C7474] text-xl"></i>
                </div>

            </div>

            <!-- Pagos pendientes -->
            <div class = "flex bg-white shadow-xl rounded-2xl p-5 border-l-4 border-[#2C7474] items-center justify-between ">
                
                <div>
                    <h3 class = "text-xs font-semibold uppercase text-gray-500">
                        Pagos pendientes
                    </h3>
                    <p class = "text-2xl font-bold text-gray-800 mt-2">
                        {{ $pagosPendientes }}
                    </p>
                    <p class = "text-xs text-gray-400 mt-1">En propiedades</p>
                </div>
                
                <div class = "w-12 h-12 flex items-center justify-center rounded-xl bg-[#2C7474]/10">
                    <i class = "fa-solid fa-clock text-[#2C7474] text-xl"></i>
                </div>

            </div>

            <!-- Pagos pagados -->
            <div class = "flex bg-white shadow-xl rounded-2xl p-5 border-l-4 border-[#2C7474] items-center justify-between ">
                
                <div>
                    <h3 class = "text-xs font-semibold uppercase text-gray-500">
                        Pagos realizados
                    </h3>
                    <p class = "text-2xl font-bold text-gray-800 mt-2">
                        {{ $pagosPagados }}
                    </p>
                    <p class = "text-xs text-gray-400 mt-1">En propiedades</p>
                </div>

                <div class = "w-12 h-12 flex items-center justify-center rounded-xl bg-[#2C7474]/10">
                    <i class = "fa-solid fa-circle-check text-[#2C7474] text-xl"></i>
                </div>
            </div>

        </div>
        
        <!-- Chart -->
        <div class = "md:px-10 ">
            <div class = "bg-white md:rounded-xl shadow-xl p-5 rounded-2xl border-t-4 border-[#2C7474] md:border-t-0 md:border-l-4 ">
                <h3 class = "text-xs font-semibold uppercase text-gray-500">
                    Gastos del Año
                </h3>
                <p class = "text-xs text-gray-400 mt-1 mb-4">Cada mes</p>

                <div class = "w-full
                            h-[180px]
                            sm:h-[220px]
                            md:h-[300px]
                            lg:h-[360px]
                            xl:h-[200px]">
                    <canvas id = "gastosChart"></canvas>
                </div>

            </div>
        </div>

    </div>

</div>

@endsection

<script src = "https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    window.gastosChartData = {
        labels: @json($labels),
        pagado: @json($dataPagado),
        pendiente: @json($dataPendiente)
    };
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/gastos-chart.js') }}"></script>