<?php

declare(strict_types=1);

namespace App\Tests\Unit\Profile;

use App\Modules\Profile\Domain\Levels;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class LevelsTest extends TestCase
{
    public function testThresholdsAndProgress(): void
    {
        self::assertSame([1, 0, 100], array_values(array_intersect_key(Levels::fromPoints(0), array_flip(['level', 'progress', 'required']))));
        self::assertSame(1, Levels::fromPoints(99)['level']);
        self::assertSame(2, Levels::fromPoints(100)['level']);
        self::assertSame(70, Levels::fromPoints(170)['progress']);
        self::assertSame(200, Levels::fromPoints(170)['required']);
        self::assertSame(3, Levels::fromPoints(300)['level']);
        self::assertSame(4, Levels::fromPoints(600)['level']);
    }

    public function testNegativePointsAreRejected(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Levels::fromPoints(-1);
    }
}
