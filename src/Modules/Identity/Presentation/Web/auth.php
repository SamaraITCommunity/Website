<?php

declare(strict_types=1);

use Yiisoft\Html\Html;

$this->setTitle($mode === 'register' ? 'Регистрация — SITC' : 'Вход — SITC');
?>
<section class="auth-card">
    <h1><?= $mode === 'register' ? 'Регистрация' : 'Вход' ?></h1>
    <?php if ($error !== ''): ?><p role="alert"><?= Html::encode($error) ?></p><?php endif; ?>
    <form method="post" action="/auth/<?= Html::encode($mode) ?>">
        <?= $csrf->hiddenInput() ?>
        <?php if ($mode === 'register'): ?>
            <label>Имя <input type="text" name="name" value="<?= Html::encode($name) ?>" minlength="2" maxlength="100" autocomplete="name" required></label>
        <?php endif; ?>
        <label>Email <input type="email" name="email" value="<?= Html::encode($email) ?>" maxlength="254" autocomplete="email" required></label>
        <label>Пароль <input type="password" name="password" minlength="12" maxlength="72" autocomplete="<?= $mode === 'register' ? 'new-password' : 'current-password' ?>" required></label>
        <button type="submit"><?= $mode === 'register' ? 'Зарегистрироваться' : 'Войти' ?></button>
    </form>
    <p><a href="<?= $mode === 'register' ? '/auth/login' : '/auth/register' ?>"><?= $mode === 'register' ? 'Уже есть аккаунт? Войти' : 'Создать аккаунт' ?></a></p>
</section>
