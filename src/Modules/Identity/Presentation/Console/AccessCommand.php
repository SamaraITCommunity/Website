<?php

declare(strict_types=1);

namespace App\Modules\Identity\Presentation\Console;

use App\Modules\Identity\Application\Authentication;
use App\Shared\Database\ConnectionFactory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'identity:set-access', description: 'Set a registered user access role')]
final class AccessCommand extends Command
{
    public function __construct(private readonly ConnectionFactory $factory) { parent::__construct(); }

    protected function configure(): void
    {
        $this->addArgument('email', InputArgument::REQUIRED)->addArgument('role', InputArgument::REQUIRED, 'user, moderator or admin');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $role = $input->getArgument('role');
        if (!in_array($role, ['user', 'moderator', 'admin'], true)) {
            $output->writeln('<error>Unknown access role.</error>');
            return Command::INVALID;
        }
        $query = $this->factory->create()->prepare('UPDATE identity.account SET access_role = :role WHERE email = :email');
        $query->execute(['role' => $role, 'email' => Authentication::normalizeEmail($input->getArgument('email'))]);
        if ($query->rowCount() !== 1) {
            $output->writeln('<error>Account not found.</error>');
            return Command::FAILURE;
        }
        $output->writeln('Access role updated.');
        return Command::SUCCESS;
    }
}
