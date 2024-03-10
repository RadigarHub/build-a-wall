<?php

declare(strict_types=1);

namespace RadigarHub\BuildAWall\Tests\Unit\Wall\Application;

use PHPUnit\Framework\TestCase;
use RadigarHub\BuildAWall\Wall\Application\Service\BuildAWallRequest;
use RadigarHub\BuildAWall\Wall\Application\Service\BuildAWallService;
use RadigarHub\BuildAWall\Wall\Domain\Model\TooManyBricksException;

class BuildAWallServiceTest extends TestCase
{
    private BuildAWallService $buildAWallService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->buildAWallService = new BuildAWallService();
    }

    /** @test */
    public function it_should_build_a_new_valid_wall(): void
    {
        $output = <<<EOT
                  ■■|■■|■■|■■|■■
                  ■|■■|■■|■■|■■|■
                  ■■|■■|■■|■■|■■
                  ■|■■|■■|■■|■■|■
                  ■■|■■|■■|■■|■■
                  EOT;

        $buildAWallRequest = new BuildAWallRequest(5, 5);
        $buildAWallResponse = $this->buildAWallService->execute($buildAWallRequest);

        $this->assertEquals($output, $buildAWallResponse->getWallRepresentation());
    }

    /**
     * @test
     * @dataProvider provideTooManyBricks
     */
    public function it_should_fail_if_the_wall_has_more_than_10000_bricks(int $wallNumberOfRows, int $wallNumberOfBricksPerRow): void
    {
        $buildAWallRequest = new BuildAWallRequest($wallNumberOfRows, $wallNumberOfBricksPerRow);

        $this->expectException(TooManyBricksException::class);
        $this->expectExceptionMessage("Naah, too much...here's my resignation.");
        $this->buildAWallService->execute($buildAWallRequest);
    }

    public function provideTooManyBricks(): array
    {
        return [
            [10001, 1],
            [1, 10001],
            [123, 1024],
        ];
    }
}
