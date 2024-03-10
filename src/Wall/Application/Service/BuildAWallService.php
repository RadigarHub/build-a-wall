<?php

declare(strict_types=1);

namespace RadigarHub\BuildAWall\Wall\Application\Service;

use RadigarHub\BuildAWall\Wall\Domain\Model\Wall;

class BuildAWallService
{

    public function __construct()
    {
    }

    public function execute(BuildAWallRequest $buildAWallRequest): buildAWallResponse
    {
        $wall = new Wall();

        return new BuildAWallResponse($wall);
    }
}
