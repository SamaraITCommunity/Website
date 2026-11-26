<?php

declare(strict_types=1);

namespace App\Modules\Identity\Domain;

final class Permissions
{
    public static function allows(string $role, string $permission): bool
    {
        return match ($permission) {
            'account.view' => in_array($role, ['user', 'moderator', 'admin'], true),
            'content.moderate' => in_array($role, ['moderator', 'admin'], true),
            'access.manage' => $role === 'admin',
            default => false,
        };
    }
}
