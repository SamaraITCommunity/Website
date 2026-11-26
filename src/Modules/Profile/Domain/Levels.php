<?php

declare(strict_types=1);

namespace App\Modules\Profile\Domain;

use InvalidArgumentException;

final class Levels
{
    /** @return array{level: int, points: int, level_start: int, next_level: int, progress: int, required: int} */
    public static function fromPoints(int $points): array
    {
        if ($points < 0) {
            throw new InvalidArgumentException('Points cannot be negative.');
        }
        $level = (int) floor((1 + sqrt(1 + $points / 12.5)) / 2);
        $start = intdiv(100 * $level * ($level - 1), 2);
        $required = 100 * $level;
        return ['level' => $level, 'points' => $points, 'level_start' => $start, 'next_level' => $level + 1, 'progress' => $points - $start, 'required' => $required];
    }
}
