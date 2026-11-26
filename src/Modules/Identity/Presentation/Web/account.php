<?php

declare(strict_types=1);

use Yiisoft\Html\Html;

$this->setTitle('Личный кабинет — SITC');
?>
<section class="auth-card">
    <h1><?= $permission === 'access.manage' ? 'Администрирование' : ($permission === 'content.moderate' ? 'Модерация' : 'Личный кабинет') ?></h1>
    <p>Здравствуйте, <?= Html::encode($account['display_name']) ?>.</p>
    <p>Доступ: <?= Html::encode($account['access_role']) ?>.</p>
    <p>Роли сообщества: <?= $roles === [] ? 'пока нет' : Html::encode(implode(', ', $roles)) ?>.</p>
    <p><a href="/account">Личный кабинет</a></p>
    <form action="/auth/logout" method="post"><?= $csrf->hiddenInput() ?><button type="submit">Выйти</button></form>
</section>
