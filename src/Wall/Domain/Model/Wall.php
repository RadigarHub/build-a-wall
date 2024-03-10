<?php

declare(strict_types=1);

namespace RadigarHub\BuildAWall\Wall\Domain\Model;

readonly class Wall
{
    public function __construct(
        private WallNumberOfRows $wallNumerOfRows,
        private WallNumberOfBricksPerRow $wallNumberOfBricksPerRow
    ) {
    }

    public static function create(
        WallNumberOfRows $wallNumerOfRows,
        WallNumberOfBricksPerRow $wallNumberOfBricksPerRow
    ): self {
        return new self($wallNumerOfRows, $wallNumberOfBricksPerRow);
    }


    public function getRepresentation(): string
    {
        return 'SHOW WALL';
    }
}
