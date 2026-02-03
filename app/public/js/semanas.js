
document.addEventListener('DOMContentLoaded', () => {

    const contenedor = document.getElementById('semanas-por-mes');
    if (!contenedor) return;

    const url = contenedor.dataset.url;

    fetch(url)
        .then(r => r.json())
        .then(data => {

            contenedor.innerHTML = '';

            // Agrupar semanas por mes
            const porMes = {};
            data.semanas.forEach(s => {
                const mes = new Date(s.inicio).toLocaleString('es-CL', { month: 'long' });
                if (!porMes[mes]) porMes[mes] = [];
                porMes[mes].push(s);
            });

            // Grid principal para meses: máximo 4 columnas
            const gridMeses = document.createElement('div');
            gridMeses.className = 'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6';
            contenedor.appendChild(gridMeses);

            Object.entries(porMes).forEach(([mes, semanas]) => {
                const bloque = document.createElement('div');

                bloque.innerHTML = `
                    <h3 class = "text-2xl md:text-xl font-semibold text-[#2C7474] capitalize mb-2">${mes}</h3>
                    <div class = "grid grid-cols-7 gap-1"></div>
                `;

                const grid = bloque.querySelector('div');

                semanas.forEach(s => {
                    const div = document.createElement('div');
                    const ocupada = s.estado === 'ocupada';

                    div.className = `
                        relative
                        aspect-square
                        flex
                        items-center
                        justify-center
                        font-semibold
                        text-sm
                        cursor-pointer
                        ${ocupada
                            ? 'border-[red]/40 bg-[red]/20 text-[#2C7474]'
                            : 'border-[#2C7474] bg-[#2C7474]/10 text-[#2C7474]'}
                    `;

                    div.textContent = s.semana_id;

                    // Tooltip
                    const tooltip = document.createElement('span');
                    tooltip.className = `
                        absolute
                        bottom-full
                        left-0
                        transform -translate-y-2
                        bg-[#2C7474]
                        ${ocupada ? 'bg-[red] text-white' : 'bg-[#2C7474] text-white'}
                        text-xs
                        font-medium
                        px-3 py-1
                        rounded-md
                        whitespace-nowrap
                        opacity-0
                        pointer-events-none
                        transition-opacity duration-200
                    `;
                    tooltip.textContent = `${s.inicio} - ${s.fin} (${ocupada ? 'Ocupada' : 'Disponible'})`;

                    div.appendChild(tooltip);

                    // Mostrar tooltip al pasar el mouse
                    div.addEventListener('mouseenter', () => {
                        tooltip.classList.remove('opacity-0');
                        tooltip.classList.add('opacity-100');
                    });
                    div.addEventListener('mouseleave', () => {
                        tooltip.classList.remove('opacity-100');
                        tooltip.classList.add('opacity-0');
                    });

                    grid.appendChild(div);
                });

                gridMeses.appendChild(bloque);
            });

        });
});
y
