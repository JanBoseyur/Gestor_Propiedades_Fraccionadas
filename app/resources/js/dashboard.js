import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', async () => {

    const meses = {
        1: 'Enero', 2: 'Febrero', 3: 'Marzo', 4: 'Abril',
        5: 'Mayo', 6: 'Junio', 7: 'Julio', 8: 'Agosto',
        9: 'Septiembre', 10: 'Octubre', 11: 'Noviembre', 12: 'Diciembre'
    };

    const res = await fetch('/admin/charts');
    const data = await res.json();

    /* ================= GASTOS ================= */
    const gastosCanvas = document.getElementById('gastosChart');

    if (gastosCanvas && Object.keys(data.gastos).length) {
        new Chart(gastosCanvas, {
            type: 'doughnut',
            data: {
                labels: Object.keys(data.gastos),
                datasets: [{ data: Object.values(data.gastos) }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    }

    /* ================= RESERVAS ================= */
    const reservasCanvas = document.getElementById('reservasMesChart');

    if (reservasCanvas && Object.keys(data.reservasPorMes).length) {
        new Chart(reservasCanvas, {
            type: 'bar',
            data: {
                labels: Object.keys(data.reservasPorMes).map(m => meses[m]),
                datasets: [{
                    label: 'Reservas',
                    data: Object.values(data.reservasPorMes)
                }]
            },
            options: {
                responsive: true,
                aspectRatio: false,
                scales: { y: { beginAtZero: true } }
            }
        });
    }

    /* ================= RECAUDADO ================= */
    const recaudadoCanvas = document.getElementById('recaudadoMesChart');

    if (recaudadoCanvas && Object.keys(data.recaudadoPorMes).length) {
        new Chart(recaudadoCanvas, {
            type: 'line',
            data: {
                labels: Object.keys(data.recaudadoPorMes).map(m => meses[m]),
                datasets: [{
                    label: 'Monto Recaudado',
                    data: Object.values(data.recaudadoPorMes),
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: { y: { beginAtZero: true } }
            }
        });
    }

});
