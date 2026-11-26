<?php

declare(strict_types=1);

$includeFormsAdminScript = true;
require __DIR__ . '/partials/chrome-start.php';
?>
<main>
    <?php require dirname(__DIR__, 2) . '/src/Modules/Forms/Presentation/Static/admin.php'; ?>
</main>
<?php require __DIR__ . '/partials/chrome-end.php'; ?>
