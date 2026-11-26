<?php

declare(strict_types=1);

use YiiPress\Render\NavigationRenderer;

$isHome = $permalink === '/';
?>
<!DOCTYPE html>
<html lang="<?= $h($language) ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $h($isHome ? $siteTitle : $entryTitle . ' — ' . $siteTitle) ?></title>
    <script>
        try {
            const theme = localStorage.getItem('sitc-theme');
            if (theme === 'dark' || theme === 'light') document.documentElement.dataset.theme = theme;
        } catch (error) {}
    </script>
    <link rel="stylesheet" href="<?= $h($themeAsset('site.css')) ?>">
    <script src="<?= $h($themeAsset('theme.js')) ?>" defer></script>
    <?php if ($includeFormsAdminScript ?? false): ?>
        <script src="<?= $h($themeAsset('forms-admin.js')) ?>" defer></script>
    <?php endif; ?>
</head>
<body>
<header class="site-header">
    <a class="brand" href="<?= $h($url('/')) ?>"><span aria-hidden="true">■</span> SITC</a>
    <div class="header-actions">
        <?php if ($nav !== null): ?>
            <?= NavigationRenderer::render($nav, 'main', $rootPath, $uiLanguage, $uiLanguage, 'site-nav', $permalink) ?>
        <?php endif; ?>
        <button class="theme-toggle" type="button" aria-label="Переключить тему" aria-pressed="false">Тёмная тема</button>
    </div>
</header>
