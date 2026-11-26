<?php

declare(strict_types=1);

use App\Web;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;

return [
    Group::create()
        ->routes(
            Route::methods(['GET', 'POST'], '/auth/{mode}')
                ->action(\App\Modules\Identity\Presentation\Web\AuthAction::class)
                ->name('identity.auth'),
            Route::get('/account')
                ->action(\App\Modules\Identity\Presentation\Web\AccountAction::class)
                ->name('identity.account'),
            Route::get('/admin')
                ->action(\App\Modules\Identity\Presentation\Web\AccountAction::class)
                ->name('identity.admin'),
            Route::get('/moderation')
                ->action(\App\Modules\Identity\Presentation\Web\AccountAction::class)
                ->name('identity.moderation'),
            Route::get('/')
                ->action(Web\HomePage\Action::class)
                ->name('home'),
        ),
];
