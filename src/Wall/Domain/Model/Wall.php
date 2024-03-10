<?php

declare(strict_types=1);

namespace RadigarHub\BuildAWall\Wall\Domain\Model;

class Wall
{
    public function getRepresentation(): string
    {
        return 'SHOW WALL';
    }
}
