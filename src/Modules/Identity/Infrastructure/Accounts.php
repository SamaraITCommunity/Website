<?php

declare(strict_types=1);

namespace App\Modules\Identity\Infrastructure;

use App\Shared\Database\ConnectionFactory;
use PDO;

final readonly class Accounts
{
    public function __construct(private ConnectionFactory $factory) {}

    public function findByEmail(string $email): ?array
    {
        $query = $this->factory->create()->prepare('SELECT * FROM identity.account WHERE email = :email');
        $query->execute(['email' => $email]);
        return $query->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function findById(int $id): ?array
    {
        $query = $this->factory->create()->prepare('SELECT id, email, display_name, access_role, is_active FROM identity.account WHERE id = :id');
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function create(string $email, string $name, string $hash): bool
    {
        $query = $this->factory->create()->prepare('INSERT INTO identity.account (email, display_name, password_hash) VALUES (:email, :name, :hash) ON CONFLICT (email) DO NOTHING');
        $query->execute(['email' => $email, 'name' => $name, 'hash' => $hash]);
        return $query->rowCount() === 1;
    }

    public function activeCommunityRoles(int $id): array
    {
        $query = $this->factory->create()->prepare('SELECT DISTINCT role FROM identity.community_role WHERE account_id = :id AND revoked_at IS NULL AND starts_at <= now() AND expires_at > now() ORDER BY role');
        $query->execute(['id' => $id]);
        return $query->fetchAll(PDO::FETCH_COLUMN);
    }

    public function allowAttempt(string $bucket, string $address): bool
    {
        $key = hash('sha256', $bucket . ':' . $address);
        $sql = "INSERT INTO identity.login_throttle (key_hash, attempts, window_started_at) VALUES (:key, 1, now()) ON CONFLICT (key_hash) DO UPDATE SET attempts = CASE WHEN identity.login_throttle.window_started_at < now() - interval '15 minutes' THEN 1 ELSE identity.login_throttle.attempts + 1 END, window_started_at = CASE WHEN identity.login_throttle.window_started_at < now() - interval '15 minutes' THEN now() ELSE identity.login_throttle.window_started_at END RETURNING attempts";
        $query = $this->factory->create()->prepare($sql);
        $query->execute(['key' => $key]);
        return (int) $query->fetchColumn() <= 10;
    }
}
