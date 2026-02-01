
let selectedWeeks = [];
let calendarInstance = null;

function initCalendar() {
    const calendarEl = document.getElementById('calendar');

    if (calendarInstance) {
        calendarInstance.updateSize();
        return;
    }

    calendarInstance = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        firstDay: 1, // lunes
        fixedWeekCount: false,
        showNonCurrentDates: false,
        height: 'auto',
        aspectRatio: 2,

        headerToolbar: {
            left: 'prev',
            center: 'title',
            right: 'next'
        },

        buttonText: {
            prev: '‹',
            next: '›'
        },

        dateClick(info) {
            const week = getISOWeek(info.date);

            if (takenWeeks.includes(week)) return;

            toggleWeek(week);
        }
    });

    calendarInstance.render();
    renderAll();

    setTimeout(() => {
        calendarInstance.updateSize();
        calendarEl.classList.remove('opacity-0');
        calendarEl.classList.add('opacity-100');
    }, 200);

    document
        .getElementById('saveSelections')
        .addEventListener('click', saveSelections);
}

/* =========================
   HELPERS CALENDARIO
========================= */

function getCurrentYear() {
    return calendarInstance.getDate().getFullYear();
}

function toggleWeek(week) {
    if (selectedWeeks.includes(week)) {
        selectedWeeks = selectedWeeks.filter(w => w !== week);
    } else {
        selectedWeeks.push(week);
    }

    renderAll();
}

function renderAll() {
    calendarInstance.removeAllEvents();
    renderTakenWeeks();
    renderSelectedWeeks();
}

/* =========================
   SEMANAS TOMADAS
========================= */

function renderTakenWeeks() {
    const year = getCurrentYear();

    takenWeeks.forEach(week => {
        const range = getWeekRange(year, week);

        calendarInstance.addEvent({
            start: range.start,
            end: range.end,
            display: 'background',
            backgroundColor: '#e5e7eb',
            overlap: false,
            extendedProps: { type: 'taken' }
        });
    });
}

/* =========================
   SEMANAS SELECCIONADAS
========================= */

function renderSelectedWeeks() {
    const year = getCurrentYear();
    const container = document.getElementById('selected-weeks');
    container.innerHTML = '';

    if (selectedWeeks.length === 0) {
        container.innerHTML = `<li class="text-gray-500 text-sm">Selecciona semanas</li>`;
        return;
    }

    selectedWeeks.forEach(week => {
        const range = getWeekRange(year, week);

        calendarInstance.addEvent({
            start: range.start,
            end: range.end,
            display: 'background',
            backgroundColor: '#93c5fd',
            extendedProps: { type: 'user' }
        });

        const start = new Date(range.start);
        const end = new Date(range.end);
        const month = start.toLocaleDateString('es-CL', { month: 'long' });

        const li = document.createElement('li');
        li.textContent = `Semana ${week} · ${capitalize(month)} (${formatDate(start)} – ${formatDate(end)})`;

        container.appendChild(li);
    });
}

/* =========================
   ISO WEEK UTILITIES
========================= */

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
    const simple = new Date(Date.UTC(year, 0, 1 + (week - 1) * 7));
    const dow = simple.getUTCDay();
    const isoMonday = new Date(simple);

    if (dow <= 4) {
        isoMonday.setUTCDate(simple.getUTCDate() - simple.getUTCDay() + 1);
    } else {
        isoMonday.setUTCDate(simple.getUTCDate() + 8 - simple.getUTCDay());
    }

    const endExclusive = new Date(isoMonday);
    endExclusive.setUTCDate(isoMonday.getUTCDate() + 7);

    return {
        start: isoMonday.toISOString().split('T')[0],
        end: endExclusive.toISOString().split('T')[0]
    };
}

/* =========================
   GUARDAR
========================= */

function saveSelections() {
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
            anio: getCurrentYear()
        })
    })
        .then(res => res.json())
        .then(data => alert(data.message))
        .catch(() => alert('Error al guardar'));
}

/* =========================
   UTILIDADES UI
========================= */

function formatDate(date) {
    return date.toLocaleDateString('es-CL', {
        day: '2-digit',
        month: '2-digit'
    });
}

function capitalize(text) {
    return text.charAt(0).toUpperCase() + text.slice(1);
}
