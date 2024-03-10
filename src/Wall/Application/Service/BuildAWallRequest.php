<?php

declare(strict_types=1);

namespace RadigarHub\BuildAWall\Wall\Application\Service;

readonly class BuildAWallRequest
{
    public function __construct(public int $numberOfRows, public int $numberOfBricksPerRow)
    {
    }
}
