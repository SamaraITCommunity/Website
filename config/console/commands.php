<?php

declare(strict_types=1);

use App\Console;

return [
    'hello' => Console\HelloCommand::class,
    'identity:set-access' => \App\Modules\Identity\Presentation\Console\AccessCommand::class,
    'identity:grant-community-role' => \App\Modules\Identity\Presentation\Console\CommunityRoleCommand::class,
    'identity:migrate' => \App\Modules\Identity\Presentation\Console\MigrateCommand::class,
];
