<?php

declare(strict_types=1);

namespace App\Modules\Identity\Infrastructure;

use App\Shared\Database\ConnectionFactory;

use PDO;
use RuntimeException;
use Throwable;

final readonly class Migrator
{
    public function __construct(private ConnectionFactory $connectionFactory) {}

    public function migrate(): int
    {
        $db = $this->connectionFactory->create();
        $directory = dirname(__DIR__, 4) . '/migrations/identity';
        $files = glob($directory . '/*.sql');
        if ($files === false) {
            throw new RuntimeException('Unable to read identity migrations.');
        }
        sort($files, SORT_STRING);
        $db->beginTransaction();
        try {
            $db->exec("SELECT pg_advisory_xact_lock(hashtext('sitc.identity.migrations'))");
            $db->exec('CREATE SCHEMA IF NOT EXISTS identity');
            $db->exec('CREATE TABLE IF NOT EXISTS identity.schema_migration (name text PRIMARY KEY, checksum text NOT NULL)');
            $get = $db->prepare('SELECT checksum FROM identity.schema_migration WHERE name = :name');
            $insert = $db->prepare('INSERT INTO identity.schema_migration (name, checksum) VALUES (:name, :checksum)');
            $count = 0;
            foreach ($files as $file) {
                $name = basename($file);
                $sql = file_get_contents($file);
                if ($sql === false) {
                    throw new RuntimeException("Unable to read migration: $name");
                }
                $checksum = hash('sha256', $sql);
                $get->execute(['name' => $name]);
                $existing = $get->fetchColumn();
                if ($existing !== false) {
                    if (!hash_equals((string) $existing, $checksum)) {
                        throw new RuntimeException("Applied migration was changed: $name");
                    }
                    continue;
                }
                $db->exec($sql);
                $insert->execute(['name' => $name, 'checksum' => $checksum]);
                ++$count;
            }
            $db->commit();
            return $count;
        } catch (Throwable $exception) {
            if ($db->inTransaction()) {
                $db->rollBack();
            }
            throw $exception;
        }
    }
}
