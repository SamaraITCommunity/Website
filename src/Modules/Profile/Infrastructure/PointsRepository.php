<?php

declare(strict_types=1);

namespace App\Modules\Profile\Infrastructure;

use App\Shared\Database\ConnectionFactory;

final readonly class PointsRepository
{
    public function __construct(private ConnectionFactory $factory) {}

    public function total(int $accountId): int
    {
        $query = $this->factory->create()->prepare('SELECT COALESCE(sum(points), 0) FROM profile.points_event WHERE account_id = :id');
        $query->execute(['id' => $accountId]);
        return (int) $query->fetchColumn();
    }

    public function award(string $email, int $points, string $key, string $reason): string
    {
        $db = $this->factory->create();
        $query = $db->prepare('INSERT INTO profile.points_event (account_id, event_key, points, reason) SELECT id, :key, :points, :reason FROM identity.account WHERE email = :email ON CONFLICT (account_id, event_key) DO NOTHING');
        $query->execute(['key' => $key, 'points' => $points, 'reason' => $reason, 'email' => $email]);
        if ($query->rowCount() === 1) {
            return 'awarded';
        }
        $check = $db->prepare('SELECT EXISTS(SELECT 1 FROM identity.account WHERE email = :email)');
        $check->execute(['email' => $email]);
        return $check->fetchColumn() ? 'duplicate' : 'missing';
    }
}
