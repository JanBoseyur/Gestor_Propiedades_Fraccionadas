
@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

<div class = "w-full min-h-screen rounded-tl-xl p-10 lg:p-0 lg:px-15">

    <!-- TÍTULO -->
    <div class = "mb-8">
        
        <h2 class = "text-4xl font-extrabold text-[#2C7474] tracking-tight">
            ¡Bienvenido Administrador!
        </h2>
        
        <p class = "mt-2 text-gray-500">
            Visualiza las últimas novedades
        </p>

    </div>

    <div class = "w-full space-y-3">

        <!-- =================== TARJETAS =================== -->
        <div class = "grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">

            <!-- Tarjeta 1 -->
            <div class = "bg-white shadow-xl rounded-xl p-5 border-l-4 border-[#2C7474] flex flex-col">
                <h3 class = "text-sm font-semibold uppercase text-gray-500">Total Reservas</h3>
                <p class = "text-2xl font-bold text-gray-800 mt-2">{{ $totalReservas }}</p>
                <p class = "text-xs text-gray-400 mt-1">Este año</p>
            </div>

            <!-- Tarjeta 2 -->
            <div class = "bg-white shadow-xl rounded-xl p-5 border-l-4 border-[#2C7474] flex flex-col">
                <h3 class = "text-sm font-semibold uppercase text-gray-500">Monto Recaudado</h3>
                <p class = "text-2xl font-bold text-gray-800 mt-2">${{ number_format($totalRecaudado, 0, ',', '.') }}</p>
                <p class = "text-xs text-gray-400 mt-1">Pagado este año</p>
            </div>

            <!-- Tarjeta 3 -->
            <div class = "bg-white shadow-xl rounded-xl p-5 border-l-4 border-[#2C7474] flex flex-col">
                <h3 class = "text-sm font-semibold uppercase text-gray-500">Pagos Pendientes</h3>
                <p class = "text-2xl font-bold text-gray-800 mt-2">{{ $totalPendientes }} ({{ $porcentajePendientes }}%)</p>
                <p class = "text-xs text-gray-400 mt-1">Del total</p>
            </div>

            <!-- Tarjeta 4 -->
            <div class = "bg-white shadow-xl rounded-xl p-5 border-l-4 border-[#2C7474] flex flex-col">
                <h3 class = "text-sm font-semibold uppercase text-gray-500">Propiedades</h3>
                <p class = "text-2xl font-bold text-gray-800 mt-2">{{ $totalPropiedades }}</p>
                <p class = "text-xs text-gray-400 mt-1">Registradas</p>
            </div>

        </div>

        <!-- ================= TARJETAS SECUNDARIAS (gráficos) ================= -->
        <div class = "grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Gastos -->
            <div class = "bg-white rounded-xl shadow-xl p-6 border-l-4 border-[#2C7474]">
                <h3 class = "text-sm font-semibold uppercase text-gray-500">
                    Estado de Gastos
                </h3>
                <p class = "text-xs text-gray-400 mb-4">
                    Pagado y Pendiente
                </p>

                <!-- CONTENEDOR RESPONSIVE -->
                <div class = "relative w-full h-52 sm:h-60 md:h-64 lg:h-72">
                    <canvas id = "gastosChart"></canvas>
                </div>
            </div>

            <!-- Reservas -->
            <div class = "bg-white rounded-xl shadow-xl p-5 border-l-4 border-[#2C7474]">
                <h3 class = "text-sm font-semibold uppercase text-gray-500">
                    Reservas por Mes
                </h3>
                <p class = "text-xs text-gray-400 mb-4">
                    Enero a Diciembre
                </p>

                <!-- CONTENEDOR RESPONSIVE -->
                <div class = "relative w-full h-56 sm:h-64 md:h-72 lg:h-80">
                    <canvas id = "reservasMesChart"></canvas>
                </div>
            </div>

        </div>

        <!-- Fila inferior: gráfico ancho -->
        <div class = "bg-white rounded-xl shadow-xl p-5 border-l-4 border-[#2C7474] mb-6">
            <h3 class = "text-sm font-semibold uppercase text-gray-500">Monto Recaudado</h3>
            <p class = "text-xs text-gray-400 mb-4">Enero a Diciembre</p>
            <canvas id = "recaudadoMesChart" class = "w-full h-64"></canvas>
        </div>

    </div>

</div>

@endsection

<script>
    const gastos = @json($gastos);
    const reservasPorMes = @json($reservasPorMes->values());
    const recaudadoPorMes = @json($recaudadoPorMes->values());
</script>
