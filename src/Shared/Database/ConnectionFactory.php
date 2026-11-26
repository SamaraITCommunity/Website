<?php

declare(strict_types=1);

namespace App\Shared\Database;

use PDO;
use RuntimeException;

final class ConnectionFactory
{
    public function create(): PDO
    {
        $host = $this->env('DB_HOST');
        $port = $this->env('DB_PORT');
        $database = $this->env('DB_NAME');
        foreach ([$host, $port, $database] as $value) {
            if (str_contains($value, ';') || str_contains($value, "\n") || str_contains($value, "\r")) {
                throw new RuntimeException('Invalid database connection setting.');
            }
        }

        return new PDO(
            "pgsql:host=$host;port=$port;dbname=$database",
            $this->env('DB_USER'),
            $this->env('DB_PASSWORD'),
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false],
        );
    }

    private function env(string $name): string
    {
        $value = getenv($name);
        if ($value === false || $value === '') {
            throw new RuntimeException("Missing database environment variable: $name");
        }
        return $value;
    }
}
