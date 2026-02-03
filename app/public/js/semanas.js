
const selectedContainer = document.getElementById('mis-selecciones'); 
const saveBtn = document.getElementById('guardar-selecciones');     

// semanas-select.js
document.addEventListener('DOMContentLoaded', () => {
    const contenedor = document.getElementById('semanas-por-mes');
    const selectedContainer = document.getElementById('mis-selecciones'); // Sección Mis Selecciones
    if (!contenedor || !selectedContainer) return;

    const url = contenedor.dataset.url;
    const selectedWeeks = []; // Semanas seleccionadas
    const currentYear = new Date().getFullYear();

    fetch(url)
        .then(res => res.json())
        .then(data => {
            contenedor.innerHTML = '';
            selectedContainer.innerHTML = '';

            // Filtrar semanas solo del año actual y agrupar por mes
            const porMes = {};
            data.semanas
                .filter(s => new Date(s.inicio).getFullYear() === currentYear)
                .forEach(s => {
                    const mes = new Date(s.inicio).toLocaleString('es-CL', { month: 'long' });
                    if (!porMes[mes]) porMes[mes] = [];
                    porMes[mes].push(s);
                });

            // Función para formatear fechas: Feb 12
            function formatDate(dateStr) {
                const d = new Date(dateStr);
                let month = d.toLocaleString('es-CL', { month: 'short' }).replace('.', '');
                month = month.charAt(0).toUpperCase() + month.slice(1);
                return `${month} ${d.getDate()}`;
            }

            // Función para obtener rango lunes-domingo
            function getWeekRange(s) {
                const inicio = new Date(s.inicio);
                const day = inicio.getDay(); // 0 = domingo, 1 = lunes ...
                const diffToMonday = (day === 0 ? -6 : 1 - day);
                const monday = new Date(inicio);
                monday.setDate(inicio.getDate() + diffToMonday);
                const sunday = new Date(monday);
                sunday.setDate(monday.getDate() + 6);
                return { start: monday, end: sunday };
            }

            // Crear grid de meses
            const gridMeses = document.createElement('div');
            gridMeses.className = 'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6';
            contenedor.appendChild(gridMeses);

            Object.entries(porMes).forEach(([mes, semanas]) => {
                const bloque = document.createElement('div');
                bloque.innerHTML = `
                    <h3 class = "text-2xl md:text-xl font-semibold text-[#2C7474] capitalize mb-2">${mes}</h3>
                    <div class = "grid grid-cols-3 gap-2"></div>
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
                        rounded-xl
                        justify-center
                        font-semibold
                        text-sm
                        cursor-pointer

                        ${ocupada
                            ? 'border-red-500 bg-red-100 text-red-700'
                            : 'border-[#2C7474] bg-[#2C7474]/10 text-[#2C7474]'}
                    `;
                    div.textContent = s.semana_id;

                    // Tooltip
                    const rango = getWeekRange(s);
                    const textoTooltip = `${formatDate(rango.start)} - ${formatDate(rango.end)} (${ocupada ? 'Ocupada' : 'Disponible'})`;
                    const tooltip = document.createElement('span');
                    
                    tooltip.className = `
                        absolute
                        bottom-full left-1/2
                        transform -translate-x-1/10 -translate-y-2
                        text-xs font-medium
                        px-2 py-1
                        rounded-md
                        whitespace-nowrap
                        opacity-0 pointer-events-none
                        transition-opacity duration-300
                        z-20

                        ${ocupada ? 'bg-[red] text-white' : 'bg-[#2C7474] text-white'}
                    `;
                    tooltip.textContent = textoTooltip;
                    div.appendChild(tooltip);

                    // Mostrar tooltip y desaparecer después de 2 segundos
                    div.addEventListener('mouseenter', () => {
                        tooltip.classList.remove('opacity-0');
                        tooltip.classList.add('opacity-100');
                        
                        if (tooltip.hideTimeout) clearTimeout(tooltip.hideTimeout);
                        tooltip.hideTimeout = setTimeout(() => {
                            tooltip.classList.remove('opacity-100');
                            tooltip.classList.add('opacity-0');
                        }, 2000);
                    });

                    div.addEventListener('mouseleave', () => {
                        tooltip.classList.remove('opacity-100');
                        tooltip.classList.add('opacity-0');
                        if (tooltip.hideTimeout) clearTimeout(tooltip.hideTimeout);
                    });

                    div.addEventListener('click', () => {
                        if (ocupada) return;

                        if (selectedWeeks.includes(s.semana_id)) {
                            selectedWeeks.splice(selectedWeeks.indexOf(s.semana_id), 1);
                            div.classList.remove('bg-[#2C7474]/30', 'border', 'border-[#2C7474]/20');
                        
                        } else {
                            selectedWeeks.push(s.semana_id);
                            div.classList.add('bg-[#2C7474]/30', 'border', 'border-[#2C7474]/20');
                        }
                        renderSelectedWeeks();
                    });

                    grid.appendChild(div);
                });

                gridMeses.appendChild(bloque);
            });

            // Botón guardar
            const saveBtn = document.getElementById('guardar-selecciones');

            saveBtn.addEventListener('click', () => {
                if (selectedWeeks.length === 0) {
                    alert('Debes seleccionar al menos una semana');
                    return;
                }

                fetch(`/propiedades/${propertyId}/selections/save`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        semana: selectedWeeks,
                        anio: currentYear
                    })
                })
                .then(res => res.json())
                .then(resData => alert(resData.message))
                .catch(() => alert('Error al guardar'));
            });

            function renderSelectedWeeks() {
                selectedContainer.innerHTML = '';

                if (selectedWeeks.length === 0) {
                    selectedContainer.innerHTML = `
                        <p class = "text-gray-700 leading-relaxed whitespace-pre-line">
                            Haz clic en las semanas disponibles del calendario para seleccionarlas
                        </p>
                    `;
                    return;
                }

                selectedWeeks.forEach(id => {
                    const s = data.semanas.find(x => x.semana_id === id);
                    const rango = getWeekRange(s);
                    const disponibilidad = s.estado === 'ocupada' ? 'Ocupada' : 'Disponible';
                    const li = document.createElement('p');
                    li.textContent = `Semana ${id} · ${formatDate(rango.start)} - ${formatDate(rango.end)}`;
                    selectedContainer.appendChild(li);
                });
            }
        });
});
