<?php

declare(strict_types=1);

namespace RadigarHub\BuildAWall\Tests\Unit\Wall\Domain\Model;

use PHPUnit\Framework\TestCase;
use RadigarHub\BuildAWall\Wall\Domain\Model\WallNumberOfBricksPerRow;

class WallNumberOfBricksPerRowTest extends TestCase
{
    /** @test */
    public function create_valid_positive(): void
    {
        $wallNumberOfBricksPerRow = WallNumberOfBricksPerRow::create(1);

        $this->assertInstanceOf(WallNumberOfBricksPerRow::class, $wallNumberOfBricksPerRow);
        $this->assertEquals(1, $wallNumberOfBricksPerRow->value);
    }

    /** @test */
    public function create_invalid_zero(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Number of bricks per row of the wall must be a positive integer.');

        WallNumberOfBricksPerRow::create(0);
    }

    /** @test */
    public function create_invalid_negative(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Number of bricks per row of the wall must be a positive integer.');

        WallNumberOfBricksPerRow::create(-1);
    }

    /** @test */
    public function compare(): void
    {
        $value = 5;
        $wallNumberOfBricksPerRow1 = WallNumberOfBricksPerRow::create($value);
        $wallNumberOfBricksPerRow2 = WallNumberOfBricksPerRow::create($value);

        $this->assertTrue($wallNumberOfBricksPerRow1->equalsTo($wallNumberOfBricksPerRow2));
    }
}
