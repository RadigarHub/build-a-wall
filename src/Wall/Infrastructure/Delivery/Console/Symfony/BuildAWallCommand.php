<?php

declare(strict_types=1);

namespace RadigarHub\BuildAWall\Wall\Infrastructure\Delivery\Console\Symfony;

use RadigarHub\BuildAWall\Wall\Application\Service\BuildAWallRequest;
use RadigarHub\BuildAWall\Wall\Application\Service\BuildAWallService;
use RadigarHub\BuildAWall\Wall\Domain\Model\TooManyBricksException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'wall:build')]
class BuildAWallCommand extends Command
{
    public function __construct(private readonly BuildAWallService $buildAWallService)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Build a new wall.');
        $this->addArgument('parameters', InputArgument::IS_ARRAY, 'Parameters of the wall');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $parameters = $input->getArgument('parameters');
        if (!$this->areParametersValid($parameters)) {
            $output->writeln('null');

            return Command::SUCCESS;
        }

        try {
            $buildAWallRequest = new BuildAWallRequest((int) $parameters[0], (int) $parameters[1]);
            $buildAWallResponse = $this->buildAWallService->execute($buildAWallRequest);
            $output->writeln($buildAWallResponse->getWallRepresentation());

            return Command::SUCCESS;
        } catch (TooManyBricksException $e) {
            $output->writeln($e->getMessage());

            return Command::SUCCESS;
        }
    }

    private function areParametersValid(array $parameters): bool
    {
        if (count($parameters) !== 2) {
            return false;
        }

        foreach ($parameters as $parameter) {
            if (!filter_var($parameter, FILTER_VALIDATE_INT)) {
                return false;
            }
            if ($parameter <= 0) {
                return false;
            }
        }

        return true;
    }
}
