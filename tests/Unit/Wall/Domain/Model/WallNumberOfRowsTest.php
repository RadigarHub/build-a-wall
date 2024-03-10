<?php

declare(strict_types=1);

namespace RadigarHub\BuildAWall\Tests\Unit\Wall\Domain\Model;

use PHPUnit\Framework\TestCase;
use RadigarHub\BuildAWall\Wall\Domain\Model\WallNumberOfRows;

class WallNumberOfRowsTest extends TestCase
{
    /** @test */
    public function create_valid_positive(): void
    {
        $wallNumberOfRows = WallNumberOfRows::create(1);

        $this->assertInstanceOf(WallNumberOfRows::class, $wallNumberOfRows);
        $this->assertEquals(1, $wallNumberOfRows->value);
    }

    /** @test */
    public function create_invalid_zero(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Number of rows of the wall must be a positive integer.');

        WallNumberOfRows::create(0);
    }

    /** @test */
    public function create_invalid_negative(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Number of rows of the wall must be a positive integer.');

        WallNumberOfRows::create(-1);
    }

    /** @test */
    public function compare(): void
    {
        $value = 5;
        $wallNumberOfRows1 = WallNumberOfRows::create($value);
        $wallNumberOfRows2 = WallNumberOfRows::create($value);

        $this->assertTrue($wallNumberOfRows1->equalsTo($wallNumberOfRows2));
    }
}
