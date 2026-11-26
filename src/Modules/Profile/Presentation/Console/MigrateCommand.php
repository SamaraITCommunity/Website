<?php

declare(strict_types=1);

namespace App\Modules\Profile\Presentation\Console;

use App\Modules\Profile\Infrastructure\Migrator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'profile:migrate', description: 'Apply profile module migrations')]
final class MigrateCommand extends Command
{
    public function __construct(private readonly Migrator $migrator)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $count = $this->migrator->migrate();
        $output->writeln("Applied profile migrations: $count");
        return Command::SUCCESS;
    }
}
