<?php

declare(strict_types=1);

namespace App\Modules\Identity\Application;

use App\Modules\Identity\Infrastructure\Accounts;
use Yiisoft\Session\SessionInterface;

final readonly class Authentication
{
    private const DUMMY_HASH = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.';
    public function __construct(private Accounts $accounts, private SessionInterface $session) {}

    public static function normalizeEmail(string $email): string
    {
        return strtolower(trim($email));
    }

    public function login(string $email, string $password): bool
    {
        $account = $this->accounts->findByEmail(self::normalizeEmail($email));
        $valid = password_verify($password, $account['password_hash'] ?? self::DUMMY_HASH);
        if (!$valid || $account === null || !$account['is_active']) {
            return false;
        }
        $this->session->regenerateId();
        $this->session->set('identity.account_id', (int) $account['id']);
        return true;
    }

    public function currentUser(): ?array
    {
        $id = $this->session->get('identity.account_id');
        if (!is_int($id)) {
            return null;
        }
        $account = $this->accounts->findById($id);
        if ($account === null || !$account['is_active']) {
            $this->session->remove('identity.account_id');
            return null;
        }
        return $account;
    }

    public function logout(): void
    {
        $this->session->remove('identity.account_id');
        $this->session->regenerateId();
    }
}
