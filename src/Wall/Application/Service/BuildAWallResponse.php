<?php

declare(strict_types=1);

namespace RadigarHub\BuildAWall\Wall\Application\Service;

use RadigarHub\BuildAWall\Wall\Domain\Model\Wall;

readonly class BuildAWallResponse
{
    public function __construct(private Wall $wall)
    {
    }

    public function getWallRepresentation(): string
    {
        return $this->wall->getRepresentation();
    }
}
