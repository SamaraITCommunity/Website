<?php

declare(strict_types=1);

namespace App\Modules\Identity\Presentation\Console;

use App\Modules\Identity\Application\Authentication;
use App\Shared\Database\ConnectionFactory;
use DateTimeImmutable;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

#[AsCommand(name: 'identity:grant-community-role', description: 'Assign a time-limited community role')]
final class CommunityRoleCommand extends Command
{
    public function __construct(private readonly ConnectionFactory $factory) { parent::__construct(); }

    protected function configure(): void
    {
        $this->addArgument('email', InputArgument::REQUIRED)->addArgument('role', InputArgument::REQUIRED, 'speaker or volunteer')->addArgument('expires-at', InputArgument::REQUIRED, 'ISO 8601 timestamp with timezone, e.g. 2027-01-01T00:00:00+04:00');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $role = $input->getArgument('role');
        $expiry = $input->getArgument('expires-at');
        if (!in_array($role, ['speaker', 'volunteer'], true) || !preg_match('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}(Z|[+-]\d{2}:\d{2})$/D', $expiry)) {
            $output->writeln('<error>Specify a supported role and an ISO 8601 timestamp with timezone.</error>');
            return Command::INVALID;
        }
        try {
            $until = new DateTimeImmutable($expiry);
        } catch (Throwable) {
            $output->writeln('<error>Invalid expiration time.</error>');
            return Command::INVALID;
        }
        if ($until <= new DateTimeImmutable()) {
            $output->writeln('<error>Expiration must be in the future.</error>');
            return Command::INVALID;
        }
        $query = $this->factory->create()->prepare('INSERT INTO identity.community_role (account_id, role, starts_at, expires_at) SELECT id, :role, now(), :expires FROM identity.account WHERE email = :email');
        $query->execute(['role' => $role, 'expires' => $until->format(DATE_ATOM), 'email' => Authentication::normalizeEmail($input->getArgument('email'))]);
        if ($query->rowCount() !== 1) {
            $output->writeln('<error>Account not found.</error>');
            return Command::FAILURE;
        }
        $output->writeln('Community role granted.');
        return Command::SUCCESS;
    }
}
