<?php

declare(strict_types=1);

namespace RadigarHub\BuildAWall\Tests\Unit\Wall\Domain\Model;

use PHPUnit\Framework\TestCase;
use RadigarHub\BuildAWall\Wall\Domain\Model\Wall;
use RadigarHub\BuildAWall\Wall\Domain\Model\WallNumberOfBricksPerRow;
use RadigarHub\BuildAWall\Wall\Domain\Model\WallNumberOfRows;

class WallTest extends TestCase
{
    /** @test */
    public function compare(): void
    {
        $wallNumberOfRows = WallNumberOfRows::create(5);
        $wallNumberOfBricksPerRow = WallNumberOfBricksPerRow::create(5);
        $wall1 = Wall::create($wallNumberOfRows, $wallNumberOfBricksPerRow);
        $wall2 = Wall::create($wallNumberOfRows, $wallNumberOfBricksPerRow);

        $this->assertTrue($wall1->equalsTo($wall2));
    }
}
