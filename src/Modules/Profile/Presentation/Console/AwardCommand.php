<?php

declare(strict_types=1);

namespace App\Modules\Profile\Presentation\Console;

use App\Modules\Identity\Application\Authentication;
use App\Modules\Profile\Infrastructure\PointsRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'profile:award', description: 'Award points for a unique event')]
final class AwardCommand extends Command
{
    public function __construct(private readonly PointsRepository $points) { parent::__construct(); }

    protected function configure(): void
    {
        $this->addArgument('email', InputArgument::REQUIRED)->addArgument('points', InputArgument::REQUIRED)->addArgument('event-key', InputArgument::REQUIRED)->addArgument('reason', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $points = $input->getArgument('points');
        $key = $input->getArgument('event-key');
        $reason = trim($input->getArgument('reason'));
        if (!preg_match('/^[1-9][0-9]{0,6}$/D', $points) || strlen($key) > 128 || !preg_match('/^[A-Za-z0-9._:-]+$/D', $key) || $reason === '' || mb_strlen($reason) > 255) {
            $output->writeln('<error>Use 1–9999999 points, a valid event key and a non-empty reason (up to 255 characters).</error>');
            return Command::INVALID;
        }
        $result = $this->points->award(Authentication::normalizeEmail($input->getArgument('email')), (int) $points, $key, $reason);
        $output->writeln(match ($result) { 'awarded' => 'Points awarded.', 'duplicate' => 'Event already recorded; no points added.', default => '<error>Account not found.</error>' });
        return $result === 'missing' ? Command::FAILURE : Command::SUCCESS;
    }
}
