<section class="events-page" aria-labelledby="events-title">
    <p class="profile-kicker">ВСТРЕЧИ САМАРСКОГО IT-СООБЩЕСТВА</p>
    <h1 id="events-title">События</h1>
    <p class="events-lead">Конференции и митапы, где можно познакомиться, обменяться опытом и найти единомышленников.</p>
    <section class="week-calendar" aria-labelledby="calendar-title">
        <div class="calendar-heading"><div><span class="profile-index">КАЛЕНДАРЬ СОБЫТИЙ</span><h2 id="calendar-title">Недели сообщества</h2><p>Предыдущая, текущая и три следующие недели. Показаны только события с известной датой.</p></div><div id="calendar-controls" class="calendar-controls" hidden><button type="button" id="calendar-prev" aria-label="Предыдущая неделя">←</button><button type="button" id="calendar-today">Сегодня</button><button type="button" id="calendar-next" aria-label="Следующая неделя">→</button></div></div>
        <p id="calendar-range" class="calendar-range" aria-live="polite"></p>
        <div class="calendar-weekdays" aria-hidden="true"><span>Пн</span><span>Вт</span><span>Ср</span><span>Чт</span><span>Пт</span><span>Сб</span><span>Вс</span></div>
        <div id="calendar-grid" class="calendar-grid"></div>
        <p class="calendar-note">События без даты находятся в списке ниже. Календарь — тестовый, автоматического добавления событий пока нет.</p>
        <noscript><p class="calendar-note">Для календаря включите JavaScript. Список событий доступен ниже.</p></noscript>
    </section>
    <section class="events-upcoming" aria-labelledby="upcoming-title">
        <div><span class="profile-index">ЧТО ДАЛЬШЕ</span><h2 id="upcoming-title">Ближайшие события</h2><p>Анонсы будущих событий пока не добавлены. Ниже можно посмотреть встречи из тестового архива.</p></div>
    </section>
    <section class="events-archive" aria-labelledby="archive-title">
        <div class="events-section-heading"><div><span class="profile-index">ПРОШЕДШИЕ И АРХИВНЫЕ МАТЕРИАЛЫ</span><h2 id="archive-title">События сообщества</h2></div><a href="<?= $h($url('/materials/')) ?>">Все материалы ↗</a></div>
        <p class="events-note">Примеры собраны из переданных материалов. Неизвестные даты и места отмечены отдельно.</p>
        <nav class="events-jump" aria-label="Разделы событий"><a href="#conferences">Конференции</a><a href="#meetups">Митапы</a></nav>
        <section id="conferences" class="events-group" aria-labelledby="conferences-title"><h3 id="conferences-title">Конференции</h3>
            <div class="events-grid">
                <article class="event-card" data-event-date="2025-04-05" data-event-title="SITConf 2025 Management"><div class="event-card-meta"><span>КОНФЕРЕНЦИЯ</span><time datetime="2025-04-05">5 апреля 2025</time></div><h4><a href="<?= $h($url('/meetings/sitconf-2025-management/')) ?>">SITConf 2025 Management</a></h4><p>Управление и развитие команд в IT.</p><div class="event-card-footer"><span>Самара · коворкинг fun(c)</span><button class="event-calendar-link" type="button" data-calendar-date="2025-04-05" hidden>В календаре</button><a href="<?= $h($url('/meetings/sitconf-2025-management/')) ?>">Подробнее ↗</a></div></article>
                <article class="event-card"><div class="event-card-meta"><span>КОНФЕРЕНЦИЯ</span><span>2024 · дата уточняется</span></div><h4><a href="<?= $h($url('/meetings/sitconf-2024-softskills/')) ?>">SITConf 2024 SoftSkills</a></h4><p>Общение, карьера и soft skills в IT.</p><div class="event-card-footer"><span>Место уточняется</span><a href="<?= $h($url('/meetings/sitconf-2024-softskills/')) ?>">Подробнее ↗</a></div></article>
            </div>
        </section>
        <section id="meetups" class="events-group" aria-labelledby="meetups-title"><h3 id="meetups-title">Митапы сообществ</h3>
            <div class="events-grid">
                <article class="event-card"><div class="event-card-meta"><span>МИТАП / PHP САМАРА</span><span>Дата уточняется</span></div><h4><a href="<?= $h($url('/meetings/php-samara-2/')) ?>">PHP Самара №2</a></h4><p>Социальная инженерия, рефакторинг и управление командами.</p><div class="event-card-footer"><span>Место уточняется</span><a href="<?= $h($url('/meetings/php-samara-2/')) ?>">Подробнее ↗</a></div></article>
                <article class="event-card"><div class="event-card-meta"><span>МИТАП / PHP САМАРА</span><span>Дата уточняется</span></div><h4><a href="<?= $h($url('/meetings/php-samara-3/')) ?>">PHP Самара №3</a></h4><p>Базы данных, ClickHouse и работа с датой и временем.</p><div class="event-card-footer"><span>Место уточняется</span><a href="<?= $h($url('/meetings/php-samara-3/')) ?>">Подробнее ↗</a></div></article>
            </div>
        </section>
    </section>
    <section class="events-speakers" aria-labelledby="events-speakers-title"><div><h2 id="events-speakers-title">Для спикеров</h2><p>Посмотрите, как может выглядеть заявка на выступление. Это пример без отправки и сохранения данных.</p></div><a href="<?= $h($url('/meetings/sitconf-2025-management/speaker-application/')) ?>">Пример заявки ↗</a></section>
</section>
