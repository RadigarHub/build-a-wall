<?php

declare(strict_types=1);

namespace RadigarHub\BuildAWall\Wall\Domain\Model;

readonly class WallNumberOfBricksPerRow extends PositiveInteger
{
    protected static function message(): string
    {
        return 'Number of bricks per row of the wall must be a positive integer.';
    }
}
