
document.addEventListener('DOMContentLoaded', () => {
    const ctx = document.getElementById('gastosChart');
    if (!ctx || !window.gastosChartData) return;

    const { labels, pagado, pendiente } = window.gastosChartData;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels,
            datasets: [
                {
                    label: 'Pagado',
                    data: pagado,
                    backgroundColor: '#37adad',
                    borderRadius: 6
                },
                {
                    label: 'Pendiente',
                    data: pendiente,
                    backgroundColor: '#2C7474',
                    borderRadius: 6
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            
            interaction: {
                mode: 'index',
                intersect: false
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: ctx => 
                            `${ctx.dataset.label}: $${ctx.raw.toLocaleString()}`
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: v => '$' + v.toLocaleString()
                    }
                }
            }
        }
    });
});

