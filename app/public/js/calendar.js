
// =============================
// VARIABLES GLOBALES
// =============================
let selectedWeeks = [];
let year = new Date().getFullYear();

document.addEventListener('DOMContentLoaded', function () {
    
    const calendarEl = document.getElementById('calendar');
    const saveBtn = document.getElementById('saveSelections');

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        firstDay: 1,
        fixedWeekCount: false,
        showNonCurrentDates: false,
        height: 'auto',

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: ''
        },

        events: events,

        dateClick(info) {
            toggleWeek(info.date);
        }
    });
    
    // 🔹 Importante: actualizar tamaño cuando se abra el modal
    // Esto evita que el calendario se vea blanco
    const modalEl = calendarEl.closest('.modal');
    if (modalEl) {
        modalEl.addEventListener('shown.bs.modal', function () {
            calendar.updateSize();
        });
    }

    calendar.render();

    // =============================
    // BOTÓN GUARDAR
    // =============================
    saveBtn.addEventListener('click', function () {

        console.log('Semanas seleccionadas:', selectedWeeks); 

        if (selectedWeeks.length === 0) {
            alert('Debes seleccionar al menos una semana');
            return;
        }

        fetch(`/propiedades/${propertyId}/selections/save`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content')
            },
            body: JSON.stringify({
                semana: selectedWeeks,
                anio: year
            })
        })
        .then(res => res.json())
        .then(data => alert(data.message))
        .catch(err => {
            console.error(err);
            alert('Error al guardar');
        });
    });

    function toggleWeek(date) {
        const week = getISOWeek(date);

        if (takenWeeks.includes(week)) {
            alert(`La semana ${week} se encuentra ocupada.`);
            return; // No permitir selección
        }

        if (selectedWeeks.includes(week)) {
            selectedWeeks = selectedWeeks.filter(w => w !== week);
        } else {
            selectedWeeks.push(week);
        }

        renderSelectedWeeks(calendar);
    }
});

// =============================
// UI + CALENDAR
// =============================
function renderSelectedWeeks(calendar) {

    calendar.getEvents().forEach(event => {
        if (event.extendedProps.type === 'user') {
            event.remove();
        }
    });

    const container = document.getElementById('selected-weeks');
    container.innerHTML = '';

    if (selectedWeeks.length === 0) {
        container.innerHTML =
            `<span class="text-gray-500 text-sm">Selecciona semanas</span>`;
        return;
    }

    selectedWeeks.forEach(week => {
        const range = getWeekRange(year, week);

        calendar.addEvent({
            start: range.start,
            end: range.end,
            display: 'background',
            backgroundColor: '#B3D3D3',
            extendedProps: { type: 'user' }
        });

        const start = new Date(range.start);
        const end = new Date(range.end);
        const month = start.toLocaleDateString('es-CL', { month: 'long' });

        const chip = document.createElement('span');
        chip.className =
            'px-3 py-1 bg-[#B3D3D3] text-[#2E6C6F] rounded-full text-sm';

        chip.innerText =
            `Semana ${week} · ${capitalize(month)} (${formatDate(start)} – ${formatDate(end)})`;

        container.appendChild(chip);
    });
}

// =============================
// HELPERS
// =============================
function getISOWeek(date) {
    const d = new Date(Date.UTC(
        date.getFullYear(),
        date.getMonth(),
        date.getDate()
    ));
    d.setUTCDate(d.getUTCDate() + 4 - (d.getUTCDay() || 7));
    const yearStart = new Date(Date.UTC(d.getUTCFullYear(), 0, 1));
    return Math.ceil((((d - yearStart) / 86400000) + 1) / 7);
}

function getWeekRange(year, week) {
    const start = new Date(year, 0, 1 + (week - 1) * 7);
    const day = start.getDay();
    const diff = start.getDate() - day + (day === 0 ? -6 : 1);

    const monday = new Date(start.setDate(diff));
    const sunday = new Date(monday);
    sunday.setDate(monday.getDate() + 7);

    return {
        start: monday.toISOString().split('T')[0],
        end: sunday.toISOString().split('T')[0]
    };
}

function formatDate(date) {
    return date.toLocaleDateString('es-CL', {
        day: '2-digit',
        month: '2-digit'
    });
}

function capitalize(text) {
    return text.charAt(0).toUpperCase() + text.slice(1);
}

const modalEl = calendarEl.closest('.modal');
if (modalEl) {
    modalEl.addEventListener('shown.bs.modal', function () {
        calendar.updateSize();
    });
}