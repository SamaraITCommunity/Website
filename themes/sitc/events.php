<?php

declare(strict_types=1);

$includeEventsScript = true;
require __DIR__ . '/partials/chrome-start.php';
?>
<main>
    <?php require dirname(__DIR__, 2) . '/src/Modules/Events/Presentation/Static/events.php'; ?>
</main>
<?php require __DIR__ . '/partials/chrome-end.php'; ?>
