    <section class="form-admin" aria-labelledby="forms-title">
        <p class="profile-kicker">ПРИМЕР ДЛЯ ОРГАНИЗАТОРОВ</p>
        <h1 id="forms-title">Формы <span>(админ)</span></h1>
        <p class="forms-lead">Шаблоны для повторного использования и формы отдельных событий — в одном месте.</p>
        <div class="concept-note"><strong>Тестовый редактор.</strong> Это открытый макет без базы и защиты доступа. Изменения живут только в этой вкладке и исчезнут после обновления; ответы не собираются. Не вводите реальные персональные данные.</div>
        <noscript><p>Для работы тестового редактора включите JavaScript.</p></noscript>
        <div class="forms-lists">
            <section class="forms-panel"><div class="forms-panel-heading"><div><span class="profile-index">ПОВТОРНОЕ ИСПОЛЬЗОВАНИЕ</span><h2>Шаблоны</h2></div></div><p>Основа для форм разных встреч.</p><div id="template-list"></div></section>
            <section class="forms-panel"><div class="forms-panel-heading"><div><span class="profile-index">ЭКЗЕМПЛЯРЫ</span><h2>Формы</h2></div><button type="button" class="forms-button forms-button-secondary" id="new-form">+ Новая</button></div><p>Черновики и примеры доступных форм.</p><div id="form-list"></div></section>
        </div>
        <section class="forms-editor" id="editor" aria-labelledby="editor-title">
            <div class="forms-panel-heading"><div><span class="profile-index">РЕДАКТОР / ПРИМЕР</span><h2 id="editor-title">Новая форма</h2></div><span id="editor-origin" class="forms-meta"></span></div>
            <div class="forms-grid"><label>Название<input id="form-title" type="text" maxlength="150" placeholder="Название формы"></label><label>Владелец<input id="form-owner" type="text" maxlength="100" placeholder="Укажите нового владельца"></label><label class="forms-full">Описание<textarea id="form-description" rows="2" placeholder="Для чего нужна форма"></textarea></label><label>Статус<select id="form-status"><option value="draft">Черновик</option><option value="open">Доступна — пример</option><option value="closed">Закрыта</option></select></label></div>
            <div class="forms-field-heading"><div><h3>Поля</h3><p>Добавляйте вопросы и меняйте их порядок.</p></div><button type="button" class="forms-button forms-button-secondary" id="add-field">+ Добавить поле</button></div>
            <div id="field-list" class="forms-field-list"></div>
            <div class="forms-actions"><button type="button" class="forms-button" id="save-form">Сохранить форму в этой вкладке</button><button type="button" class="forms-button forms-button-secondary" id="save-template">Сохранить как шаблон</button></div><p id="forms-message" class="forms-message" role="status" aria-live="polite"></p>
        </section>
        <section class="forms-preview" aria-labelledby="preview-title"><span class="profile-index">ПРЕДВАРИТЕЛЬНЫЙ ПРОСМОТР</span><h2 id="preview-title">Как увидит участник</h2><div id="preview"></div><p class="forms-meta">Демонстрация: ответы не отправляются.</p></section>
    </section>
