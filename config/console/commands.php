<?php

declare(strict_types=1);

use App\Console;

return [
    'hello' => Console\HelloCommand::class,
    'identity:set-access' => \App\Modules\Identity\Presentation\Console\AccessCommand::class,
    'identity:grant-community-role' => \App\Modules\Identity\Presentation\Console\CommunityRoleCommand::class,
    'profile:award' => \App\Modules\Profile\Presentation\Console\AwardCommand::class,
    'profile:migrate' => \App\Modules\Profile\Presentation\Console\MigrateCommand::class,
    'identity:migrate' => \App\Modules\Identity\Presentation\Console\MigrateCommand::class,
];
