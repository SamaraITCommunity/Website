<?php

declare(strict_types=1);

require __DIR__ . '/partials/chrome-start.php';
?>
<main>
    <article class="development-plan">
        <p class="profile-kicker">ПЕРВАЯ ВСТРЕЧА АДМИНИСТРАТОРОВ</p>
        <h1><?= $h($entryTitle) ?></h1>
        <div class="page-content"><?= $content ?></div>
    </article>
</main>
<?php require __DIR__ . '/partials/chrome-end.php'; ?>
