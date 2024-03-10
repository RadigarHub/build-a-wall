<?php

declare(strict_types=1);

namespace RadigarHub\BuildAWall\Wall\Application\Service;

use RadigarHub\BuildAWall\Wall\Domain\Model\Wall;
use RadigarHub\BuildAWall\Wall\Domain\Model\WallNumberOfBricksPerRow;
use RadigarHub\BuildAWall\Wall\Domain\Model\WallNumberOfRows;

class BuildAWallService
{

    public function __construct()
    {
    }

    public function execute(BuildAWallRequest $buildAWallRequest): buildAWallResponse
    {
        $wallNumerOfRows = WallNumberOfRows::create($buildAWallRequest->numberOfRows);
        $wallNumberOfBricksPerRow = WallNumberOfBricksPerRow::create($buildAWallRequest->numberOfBricksPerRow);
        $wall = Wall::create($wallNumerOfRows, $wallNumberOfBricksPerRow);

        return new BuildAWallResponse($wall);
    }
}
