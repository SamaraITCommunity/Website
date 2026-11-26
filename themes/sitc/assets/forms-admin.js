(() => {
    const byId = (id) => document.getElementById(id);
    const types = { text: 'Короткий текст', textarea: 'Длинный текст', email: 'Email', phone: 'Телефон', url: 'Ссылка', single: 'Один вариант', multiple: 'Несколько вариантов', confirm: 'Подтверждение' };
    const field = (label, type = 'text', required = false, options = []) => ({ label, type, required, options });
    const clone = (value) => JSON.parse(JSON.stringify(value));
    const templates = [{ name: 'Заявка спикера', creator: 'Команда SITC · пример', description: 'Повторно используемый набор вопросов для докладчиков.', fields: [field('Имя', 'text', true), field('Фамилия', 'text', true), field('Город', 'text', true), field('Телефон', 'phone', true), field('Email', 'email', true), field('Telegram'), field('Название доклада', 'text', true), field('Описание доклада', 'textarea', true), field('О себе', 'textarea'), field('Ссылка на фотографию', 'url'), field('Компания'), field('Должность')] }];
    const forms = [{ title: 'Заявка спикера · SITConf 2025', owner: 'Команда SITC · пример', description: 'Пример формы прошедшей конференции.', status: 'closed', origin: 'Шаблон «Заявка спикера»', fields: clone(templates[0].fields) }];
    let draft = blank();
    let editing = null;
    function blank() { return { title: '', owner: '', description: '', status: 'draft', origin: 'Новая форма', fields: [] }; }
    function el(tag, text, className) { const node = document.createElement(tag); if (text !== undefined) node.textContent = text; if (className) node.className = className; return node; }
    function button(label, handler, className = 'forms-link-button') { const b = el('button', label, className); b.type = 'button'; b.addEventListener('click', handler); return b; }
    function notice(message) { byId('forms-message').textContent = message; }
    function openDraft(value, index = null) { draft = clone(value); editing = index; sync(); byId('editor').scrollIntoView({ behavior: 'smooth', block: 'start' }); }
    function sync() {
        byId('form-title').value = draft.title; byId('form-owner').value = draft.owner; byId('form-description').value = draft.description; byId('form-status').value = draft.status;
        byId('editor-title').textContent = editing === null ? 'Новая форма' : 'Редактирование формы'; byId('editor-origin').textContent = draft.origin; notice(''); renderFields(); renderPreview();
    }
    function lists() {
        const templateList = byId('template-list'); templateList.replaceChildren();
        templates.forEach((template) => {
            const item = el('div', undefined, 'forms-list-item'); const details = el('div'); details.append(el('strong', template.name), el('small', 'Создатель: ' + template.creator));
            item.append(details, button('Использовать', () => openDraft({ title: template.name, owner: '', description: template.description, status: 'draft', origin: 'Шаблон «' + template.name + '»', fields: clone(template.fields) }))); templateList.append(item);
        });
        const formList = byId('form-list'); formList.replaceChildren();
        forms.forEach((form, index) => {
            const item = el('div', undefined, 'forms-list-item'); const details = el('div'); const statuses = { draft: 'Черновик', open: 'Доступна · пример', closed: 'Закрыта' };
            details.append(el('strong', form.title), el('small', statuses[form.status] + ' · Владелец: ' + form.owner));
            const actions = el('div', undefined, 'forms-list-actions'); actions.append(button('Изменить', () => openDraft(form, index)), button('Дублировать', () => openDraft({ ...clone(form), title: form.title + ' — копия', owner: '', status: 'draft', origin: 'Копия формы «' + form.title + '»' })));
            item.append(details, actions); formList.append(item);
        });
    }
    function labelWrap(title, input, className) { const label = el('label', undefined, className); label.append(el('span', title), input); return label; }
    function input(type, value) { const node = document.createElement('input'); node.type = type; if (type === 'checkbox') node.checked = value; else node.value = value; return node; }
    function renderFields() {
        const list = byId('field-list'); list.replaceChildren();
        if (!draft.fields.length) { list.append(el('p', 'Пока нет полей. Добавьте первое или выберите шаблон.', 'forms-meta')); return; }
        draft.fields.forEach((question, index) => {
            const item = el('div', undefined, 'forms-field'); const head = el('div', undefined, 'forms-field-top'); head.append(el('strong', 'Поле ' + (index + 1)));
            const controls = el('div', undefined, 'forms-list-actions');
            const up = button('↑', () => { [draft.fields[index - 1], draft.fields[index]] = [draft.fields[index], draft.fields[index - 1]]; renderFields(); renderPreview(); }); up.disabled = index === 0; up.setAttribute('aria-label', 'Переместить поле вверх');
            const down = button('↓', () => { [draft.fields[index + 1], draft.fields[index]] = [draft.fields[index], draft.fields[index + 1]]; renderFields(); renderPreview(); }); down.disabled = index === draft.fields.length - 1; down.setAttribute('aria-label', 'Переместить поле вниз');
            controls.append(up, down, button('Удалить', () => { draft.fields.splice(index, 1); renderFields(); renderPreview(); })); head.append(controls); item.append(head);
            const grid = el('div', undefined, 'forms-grid'); const name = input('text', question.label); name.maxLength = 150; name.addEventListener('input', () => { question.label = name.value; renderPreview(); });
            const type = document.createElement('select'); Object.entries(types).forEach(([key, label]) => { const option = el('option', label); option.value = key; type.append(option); }); type.value = question.type; type.addEventListener('change', () => { question.type = type.value; renderFields(); renderPreview(); });
            grid.append(labelWrap('Вопрос', name), labelWrap('Тип поля', type));
            if (['single', 'multiple'].includes(question.type)) { const opts = document.createElement('textarea'); opts.rows = 3; opts.placeholder = 'Каждый вариант с новой строки'; opts.value = question.options.join('\n'); opts.addEventListener('input', () => { question.options = opts.value.split('\n'); renderPreview(); }); grid.append(labelWrap('Варианты ответа', opts, 'forms-full')); }
            const required = input('checkbox', question.required); required.addEventListener('change', () => { question.required = required.checked; renderPreview(); }); const reqLabel = el('label', undefined, 'forms-checkbox'); reqLabel.append(required, document.createTextNode(' Обязательное поле'));
            item.append(grid, reqLabel); list.append(item);
        });
    }
    function renderPreview() {
        const container = byId('preview'); container.replaceChildren(); container.append(el('h3', draft.title || 'Название формы'));
        if (draft.description) container.append(el('p', draft.description));
        if (!draft.fields.length) container.append(el('p', 'Здесь появятся вопросы.', 'forms-meta'));
        draft.fields.forEach((q) => {
            const block = el('div', undefined, 'preview-field'); block.append(el('strong', (q.label || 'Вопрос') + (q.required ? ' *' : '')));
            if (['single', 'multiple'].includes(q.type)) {
                const options = q.options.filter((o) => o.trim() !== '');
                if (!options.length) block.append(el('small', 'Добавьте варианты ответа.'));
                options.forEach((value) => { const row = el('label', undefined, 'preview-option'); const control = input(q.type === 'single' ? 'radio' : 'checkbox', false); control.disabled = true; row.append(control, document.createTextNode(' ' + value)); block.append(row); });
            } else if (q.type === 'confirm') { const row = el('label', undefined, 'preview-option'); const control = input('checkbox', false); control.disabled = true; row.append(control, document.createTextNode(' Подтверждаю')); block.append(row); }
            else { const control = q.type === 'textarea' ? document.createElement('textarea') : input(({ phone: 'tel', url: 'url', email: 'email' })[q.type] || 'text', ''); control.disabled = true; control.placeholder = 'Ответ'; block.append(control); }
            container.append(block);
        });
    }
    ['title', 'owner', 'description'].forEach((key) => byId('form-' + key).addEventListener('input', (event) => { draft[key] = event.target.value; if (key !== 'owner') renderPreview(); }));
    byId('form-status').addEventListener('change', (event) => { draft.status = event.target.value; });
    byId('new-form').addEventListener('click', () => openDraft(blank()));
    byId('add-field').addEventListener('click', () => { draft.fields.push(field('')); renderFields(); renderPreview(); });
    function validate() {
        if (!draft.title.trim() || !draft.owner.trim()) return 'Укажите название и владельца.';
        if (!draft.fields.length || draft.fields.some((q) => !q.label.trim())) return 'Добавьте поля и заполните названия вопросов.';
        if (draft.fields.some((q) => ['single', 'multiple'].includes(q.type) && q.options.filter((v) => v.trim()).length < 2)) return 'Для выбора добавьте как минимум два варианта.';
        return '';
    }
    byId('save-form').addEventListener('click', () => { const error = validate(); if (error) { notice(error); return; } if (editing === null) { forms.push(clone(draft)); editing = forms.length - 1; } else forms[editing] = clone(draft); lists(); byId('editor-title').textContent = 'Редактирование формы'; notice('Форма сохранена только в этой вкладке.'); });
    byId('save-template').addEventListener('click', () => { const error = validate(); if (error) { notice(error); return; } templates.push({ name: draft.title, creator: draft.owner, description: draft.description, fields: clone(draft.fields) }); lists(); notice('Шаблон сохранён только в этой вкладке.'); });
    lists(); sync();
})();
