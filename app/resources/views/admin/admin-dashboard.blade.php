
@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
<div class="w-full min-h-screen bg-gray-50 p-6">
    <h2 class="text-3xl font-extrabold text-[#2E6C6F] text-center mb-10">Dashboard de Administrador</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Total de propiedades -->
        <div class="bg-white p-6 rounded-xl shadow-md text-center">
            <h3 class="font-bold text-gray-700 mb-2">Total de Propiedades</h3>
            <p class="text-3xl font-extrabold text-[#2E6C6F]">{{ $totalPropiedades ?? 0 }}</p>
        </div>

        <!-- Gastos comunes -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="font-bold text-gray-700 mb-2">Gastos Comunes</h3>
            <canvas id="gastosChart"></canvas>
        </div>

        <!-- Reservas por año -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="font-bold text-gray-700 mb-2">Reservas por Año</h3>
            <canvas id="reservasChart"></canvas>
        </div>

        <!-- Amenidades -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="font-bold text-gray-700 mb-2">Amenidades Populares</h3>
            <canvas id="amenidadesChart"></canvas>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ===================== GASTOS =====================
    const gastosData = {!! json_encode($gastos ?? []) !!};
    if(Object.keys(gastosData).length > 0){
        new Chart(document.getElementById('gastosChart'), {
            type: 'doughnut',
            data: {
                labels: Object.keys(gastosData),
                datasets: [{
                    data: Object.values(gastosData),
                    backgroundColor: ['#2E6C6F', '#A0AEC0']
                }]
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
        });
    }

    // ===================== RESERVAS POR AÑO =====================
    const reservasData = {!! json_encode($reservasPorAño ?? []) !!};
    if(Object.keys(reservasData).length > 0){
        new Chart(document.getElementById('reservasChart'), {
            type: 'bar',
            data: {
                labels: Object.keys(reservasData),
                datasets: [{
                    label: 'Reservas',
                    data: Object.values(reservasData),
                    backgroundColor: '#2E6C6F'
                }]
            },
            options: { responsive: true }
        });
    }

    // ===================== AMENIDADES =====================
    const amenidadesData = {!! json_encode($amenidadesArray ?? []) !!};
    if(Object.keys(amenidadesData).length > 0){
        new Chart(document.getElementById('amenidadesChart'), {
            type: 'bar',
            data: {
                labels: Object.keys(amenidadesData),
                datasets: [{
                    label: 'Cantidad',
                    data: Object.values(amenidadesData),
                    backgroundColor: '#2E6C6F'
                }]
            },
            options: { responsive: true, indexAxis: 'y' } // horizontal
        });
    }

});
</script>
@endpush
