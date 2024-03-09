<?php

declare(strict_types=1);

namespace RadigarHub\BuildAWall\Tests\Application\Wall\Infrastructure\Delivery\Console\Symfony;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class BuildAWallCommandTest extends KernelTestCase
{
    private CommandTester $commandTester;

    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
        $application = new Application(self::$kernel);
        $this->commandTester = new CommandTester($application->find('wall:build'));
    }

    /**
     * @test
     * @dataProvider provideArguments
     */
    public function execute_with_different_arguments(array $arguments, string $expectedOutput): void
    {
        $this->commandTester->execute($arguments);

        $this->commandTester->assertCommandIsSuccessful();
        $this->assertStringContainsString($expectedOutput, $this->commandTester->getDisplay());
    }

    public function provideArguments(): array
    {
        return [
            [['parameters' => [5, 5]], 'SHOW WALL'],
            [['parameters' => ['10', '7']], 'SHOW WALL'],
            [['parameters' => ['eight', 'five']], 'null'],
            [['parameters' => [[3], [5]]], 'null'],
            [['parameters' => [0, 0]], 'null'],
            [['parameters' => [-3, -5]], 'null'],
            [['parameters' => [5.5, 3.3]], 'null'],
            [['parameters' => [null, null]], 'null'],
            [['parameters' => [true, false]], 'null'],
            [[], 'null'],
            [['parameters' => [3]], 'null'],
            [['parameters' => [3, 5, 8]], 'null'],
            [['parameters' => [1, 10000]], 'SHOW WALL'],
            [['parameters' => [10000, 1]], 'SHOW WALL'],
            [['parameters' => [1, 10001]], "Naah, too much...here's my resignation."],
            [['parameters' => [10001, 1]], "Naah, too much...here's my resignation."],
        ];
    }
}
