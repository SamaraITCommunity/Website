<?php

declare(strict_types=1);

preg_match('/^./u', $entryTitle, $initial);
?>
<article class="profile-page participant-profile" aria-labelledby="participant-name">
    <p class="profile-kicker">УЧАСТНИК СООБЩЕСТВА <span> / </span> ТЕСТОВАЯ КАРТОЧКА</p>
    <div class="profile-card">
        <header class="profile-intro">
            <div class="profile-avatar" aria-label="Фотография не добавлена"><span><?= $h($initial[0] ?? '') ?></span></div>
            <div class="profile-heading">
                <div class="profile-heading-top"><span class="profile-label">САМАРСКОЕ IT-СООБЩЕСТВО</span></div>
                <h1 id="participant-name"><?= $h($entryTitle) ?></h1>
                <p class="profile-work">Участник событий SITC</p>
            </div>
        </header>
        <div class="participant-content page-content"><?= $content ?></div>
        <div class="profile-card-footer"><span>■ <strong>SITC</strong> <span class="profile-footer-divider">/</span> СВОИ ЛЮДИ, ОБЩИЕ ИДЕИ</span><span>ТЕСТОВАЯ КАРТОЧКА</span></div>
    </div>
</article>
