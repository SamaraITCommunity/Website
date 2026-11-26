    <section class="speaker-page" aria-labelledby="speaker-title">
        <p class="profile-kicker">SITCONF 2025 MANAGEMENT / ПРИМЕР</p>
        <h1 id="speaker-title">Заявка спикера</h1>
        <p class="speaker-lead">Макет формы для тех, кто хочет поделиться опытом на конференции. В качестве примера использованы вопросы из заявки SITConf 2025 Management.</p>
        <div class="concept-note"><strong>Это демонстрация.</strong> Приём заявок на прошедшую конференцию закрыт. Данные не отправляются и не сохраняются — не вводите реальные контактные данные.</div>
        <div class="speaker-fields">
            <h2>О спикере</h2><p>Расскажите немного о себе. Звёздочкой отмечены обязательные поля из исходной формы.</p>
            <div class="speaker-grid"><label>Имя <span>*</span><input type="text" autocomplete="off" placeholder="Имя"></label><label>Фамилия <span>*</span><input type="text" autocomplete="off" placeholder="Фамилия"></label><label>Город <span>*</span><input type="text" autocomplete="off" placeholder="Город"></label><label>Компания<input type="text" autocomplete="off" placeholder="Компания"></label><label>Должность<input type="text" autocomplete="off" placeholder="Должность"></label></div>
            <label>О себе<textarea rows="3" placeholder="Опыт, навыки, достижения и интересы"></textarea></label>
            <label>Ссылка на фотографию<input type="url" autocomplete="off" placeholder="https://..."></label>
            <h2>Контакты</h2><p>Для связи с организаторами; не предназначены для публикации.</p>
            <div class="speaker-grid"><label>Телефон <span>*</span><input type="tel" autocomplete="off" placeholder="Телефон"></label><label>Email <span>*</span><input type="email" autocomplete="off" placeholder="Email"></label><label>Telegram<input type="text" autocomplete="off" placeholder="@ник или t.me/..."></label></div>
            <h2>О докладе</h2><div class="speaker-grid"><label class="speaker-full">Название доклада <span>*</span><input type="text" placeholder="Название"></label><label class="speaker-full">Описание доклада <span>*</span><textarea rows="5" placeholder="О чём вы хотите рассказать?"></textarea></label></div>
            <button type="button" disabled>Отправка недоступна в примере</button>
            <p><a href="<?= $h($url('/meetings/sitconf-2025-management/')) ?>">← Вернуться к конференции</a></p>
        </div>
    </section>
