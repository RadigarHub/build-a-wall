<?php

declare(strict_types=1);

namespace RadigarHub\BuildAWall\Tests\Unit\Wall\Application;

use PHPUnit\Framework\TestCase;
use RadigarHub\BuildAWall\Wall\Application\Service\BuildAWallRequest;
use RadigarHub\BuildAWall\Wall\Application\Service\BuildAWallService;

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
        $buildAWallRequest = new BuildAWallRequest(3, 5);
        $buildAWallResponse = $this->buildAWallService->execute($buildAWallRequest);

        $this->assertEquals('SHOW WALL', $buildAWallResponse->getWallRepresentation());
    }
}
