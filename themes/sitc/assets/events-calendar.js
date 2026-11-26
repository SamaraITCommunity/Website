(() => {
    const grid = document.getElementById('calendar-grid');
    const controls = document.getElementById('calendar-controls');
    const range = document.getElementById('calendar-range');
    if (!grid || !controls || !range) return;
    const calendar = document.querySelector('.week-calendar');
    const dates = new Intl.DateTimeFormat('ru-RU', { day: 'numeric', month: 'long', year: 'numeric' });
    const dayName = new Intl.DateTimeFormat('ru-RU', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
    const startOfWeek = (date) => { const d = new Date(date.getFullYear(), date.getMonth(), date.getDate(), 12); d.setDate(d.getDate() - (d.getDay() + 6) % 7); return d; };
    const shift = (date, days) => { const d = new Date(date); d.setDate(d.getDate() + days); return d; };
    const key = (d) => [d.getFullYear(), String(d.getMonth() + 1).padStart(2, '0'), String(d.getDate()).padStart(2, '0')].join('-');
    const parse = (value) => { const [year, month, day] = value.split('-').map(Number); return new Date(year, month - 1, day, 12); };
    let focusWeek = startOfWeek(new Date());
    const events = Array.from(document.querySelectorAll('[data-event-date]')).map((card) => ({ date: card.dataset.eventDate, title: card.dataset.eventTitle, url: card.querySelector('h4 a').href }));
    function render() {
        const start = shift(focusWeek, -7); const end = shift(start, 34); const today = key(new Date());
        range.textContent = dates.format(start) + ' — ' + dates.format(end);
        grid.replaceChildren();
        for (let i = 0; i < 35; i++) {
            const date = shift(start, i); const cell = document.createElement('div'); cell.className = 'calendar-day';
            const label = document.createElement('span'); label.className = 'calendar-day-number'; label.textContent = String(date.getDate()); label.setAttribute('aria-label', dayName.format(date));
            if (key(date) === today) { cell.classList.add('calendar-day-today'); label.setAttribute('aria-current', 'date'); }
            if (i >= 7 && i < 14) cell.classList.add('calendar-current-week');
            cell.append(label);
            events.filter((event) => event.date === key(date)).forEach((event) => { const link = document.createElement('a'); link.className = 'calendar-event'; link.href = event.url; link.textContent = event.title; cell.append(link); });
            grid.append(cell);
        }
    }
    document.getElementById('calendar-prev').addEventListener('click', () => { focusWeek = shift(focusWeek, -7); render(); });
    document.getElementById('calendar-next').addEventListener('click', () => { focusWeek = shift(focusWeek, 7); render(); });
    document.getElementById('calendar-today').addEventListener('click', () => { focusWeek = startOfWeek(new Date()); render(); });
    document.querySelectorAll('[data-calendar-date]').forEach((button) => { button.hidden = false; button.addEventListener('click', () => { focusWeek = startOfWeek(parse(button.dataset.calendarDate)); render(); calendar.scrollIntoView({ behavior: 'smooth', block: 'start' }); }); });
    controls.hidden = false;
    render();
})();
