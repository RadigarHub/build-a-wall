<?php

declare(strict_types=1);

namespace RadigarHub\BuildAWall\Wall\Domain\Model;

readonly class WallNumberOfRows extends PositiveInteger
{
    protected static function message(): string
    {
        return 'Number of rows of the wall must be a positive integer.';
    }
}
