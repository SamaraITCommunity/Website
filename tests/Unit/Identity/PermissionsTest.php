<?php

declare(strict_types=1);

namespace App\Tests\Unit\Identity;

use App\Modules\Identity\Domain\Permissions;
use PHPUnit\Framework\TestCase;

final class PermissionsTest extends TestCase
{
    public function testAccessIsExplicitAndHierarchical(): void
    {
        self::assertTrue(Permissions::allows('user', 'account.view'));
        self::assertFalse(Permissions::allows('user', 'content.moderate'));
        self::assertTrue(Permissions::allows('moderator', 'content.moderate'));
        self::assertFalse(Permissions::allows('moderator', 'access.manage'));
        self::assertTrue(Permissions::allows('admin', 'access.manage'));
        self::assertFalse(Permissions::allows('speaker', 'access.manage'));
        self::assertFalse(Permissions::allows('admin', 'unknown'));
    }
}
