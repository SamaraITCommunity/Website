    <section class="tasks-page" aria-labelledby="tasks-title">
        <p class="profile-kicker">ВМЕСТЕ ДЕЛАЕМ СООБЩЕСТВО</p>
        <h1 id="tasks-title">Доска задач</h1>
        <p class="tasks-lead">Найдите дело, в котором хочется поучаствовать: помочь на встрече, поделиться опытом или поддержать проект.</p>
        <div class="concept-note"><strong>Черновик для обсуждения.</strong> Ниже — тестовые объявления для сайта и условного PHP-митапа №4. Это не реальные вакансии: отклики, учёт мест и награды пока не работают.</div>
        <div class="tasks-board-heading"><div><p class="profile-index">ПРИМЕР / САЙТ SITC · ГИЛЬДИЯ ВЕБА</p><h2>Помочь с сайтом</h2></div><a href="<?= $h($url('/guilds/web/')) ?>">О гильдии ↗</a></div>
        <p class="tasks-board-description">Помощь нужна не только с кодом: можно найти материалы, подготовить тексты или проверить информацию.</p>
        <div class="tasks-grid">
            <article class="task-card"><div class="task-meta"><span>ПОИСК МАТЕРИАЛОВ</span><span>Нужен 1 человек</span></div><h3><a href="<?= $h($url('/tasks/site-materials/')) ?>">Найти записи докладов</a></h3><p>Собрать ссылки на записи прошедших встреч, чтобы добавить их в раздел материалов.</p><div class="task-reward">✦ Очки и медаль за вклад <small>пример</small></div><a class="task-more" href="<?= $h($url('/tasks/site-materials/')) ?>">Подробнее ↗</a></article>
            <article class="task-card"><div class="task-meta"><span>ПОДГОТОВКА ТЕКСТОВ</span><span>Нужен 1 человек</span></div><h3><a href="<?= $h($url('/tasks/site-content/')) ?>">Помочь наполнить сайт</a></h3><p>Подготовить описание прошедшей встречи и согласовать его с организатором.</p><div class="task-reward">✦ Очки и медаль за вклад <small>пример</small></div><a class="task-more" href="<?= $h($url('/tasks/site-content/')) ?>">Подробнее ↗</a></article>
        </div>
        <div class="concept-note"><strong>Как могут работать уведомления:</strong> участники сообществ гильдии и люди, указавшие подходящее направление в «Чем могу помочь», смогут получать предложения по своим настройкам. Пример не отправляет уведомления.</div>
        <div class="tasks-board-heading"><div><p class="profile-index">ПРИМЕР / PHP САМАРА</p><h2>Подготовка митапа №4</h2></div><a href="<?= $h($url('/communities/php-samara/')) ?>">О сообществе ↗</a></div>
        <p class="tasks-board-description">Сообщество: <a href="<?= $h($url('/communities/php-samara/')) ?>">PHP Самара</a> · Гильдия: <a href="<?= $h($url('/guilds/web/')) ?>">Гильдия веба</a> · Инициатор: <a href="<?= $h($url('/members/alexey-sundukov/')) ?>">Алексей Сундуков</a> (пример)</p>
        <p class="tasks-board-description">Одна встреча может включать несколько разных задач. У каждой — своё количество людей и возможная награда.</p>
        <div class="tasks-grid">
            <article class="task-card"><div class="task-meta"><span>ВОЛОНТЁРСТВО</span><span>Нужно 2 человека</span></div><h3><a href="<?= $h($url('/tasks/php4-chairs/')) ?>">Помочь со стульями</a></h3><p>Расставить стулья перед встречей и помочь привести зал в порядок после.</p><div class="task-reward">✦ Очки и медаль волонтёра <small>пример</small></div><a class="task-more" href="<?= $h($url('/tasks/php4-chairs/')) ?>">Подробнее ↗</a></article>
            <article class="task-card"><div class="task-meta"><span>ОРГАНИЗАЦИЯ</span><span>Нужен 1 человек</span></div><h3><a href="<?= $h($url('/tasks/php4-venue/')) ?>">Найти площадку</a></h3><p>Помочь подобрать подходящее место для встречи и связаться с площадкой.</p><div class="task-reward">✦ Очки и достижение организатора <small>пример</small></div><a class="task-more" href="<?= $h($url('/tasks/php4-venue/')) ?>">Подробнее ↗</a></article>
            <article class="task-card"><div class="task-meta"><span>ВСТРЕЧА ГОСТЕЙ</span><span>Нужно 2 человека</span></div><h3><a href="<?= $h($url('/tasks/php4-guests/')) ?>">Встретить участников</a></h3><p>Помочь гостям найти зал, сориентироваться на площадке и проводить их.</p><div class="task-reward">✦ Очки и медаль волонтёра <small>пример</small></div><a class="task-more" href="<?= $h($url('/tasks/php4-guests/')) ?>">Подробнее ↗</a></article>
        </div>
        <p class="tasks-footnote">Награды и количество участников приведены для примера. Возможные роли и условия участия определяет организатор, а не автоматическая система.</p>
    </section>
