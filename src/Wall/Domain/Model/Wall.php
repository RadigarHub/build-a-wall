<?php

declare(strict_types=1);

namespace RadigarHub\BuildAWall\Wall\Domain\Model;

readonly class Wall
{
    private const string FULL_BRICK = '■■';
    private const string HALF_BRICK = '■';
    private const string MORTAR = '|';

    public function __construct(
        private WallNumberOfRows $wallNumerOfRows,
        private WallNumberOfBricksPerRow $wallNumberOfBricksPerRow
    ) {
    }

    public static function create(
        WallNumberOfRows $wallNumerOfRows,
        WallNumberOfBricksPerRow $wallNumberOfBricksPerRow
    ): self {
        self::validateTotalNumberOfBricks($wallNumerOfRows, $wallNumberOfBricksPerRow);

        return new self($wallNumerOfRows, $wallNumberOfBricksPerRow);
    }

    private static function validateTotalNumberOfBricks(
        WallNumberOfRows $wallNumerOfRows,
        WallNumberOfBricksPerRow $wallNumberOfBricksPerRow
    ): void {
        $numberOfBricks = $wallNumerOfRows->value * $wallNumberOfBricksPerRow->value;
        if ($numberOfBricks > 10000) {
            throw new TooManyBricksException();
        }
    }


    public function getRepresentation(): string
    {
        $wallRows = [];
        for ($i = 0; $i < $this->wallNumerOfRows->value; $i++) {
            $briksLaid = 0.0;
            $wallRowRepresentation = '';
            while ($briksLaid < $this->wallNumberOfBricksPerRow->value) {
                if (($i % 2 !== 0) && ($briksLaid === 0.0 || $briksLaid === $this->wallNumberOfBricksPerRow->value - 0.5)) {
                    $wallRowRepresentation .= self::HALF_BRICK;
                    $wallRowRepresentation .= $briksLaid === $this->wallNumberOfBricksPerRow->value - 0.5 ? '' : self::MORTAR;
                    $briksLaid += 0.5;
                } else {
                    $wallRowRepresentation .= self::FULL_BRICK;
                    $wallRowRepresentation .= $briksLaid === $this->wallNumberOfBricksPerRow->value - 1.0 ? '' : self::MORTAR;
                    ++$briksLaid;
                }
            }
            $wallRows[] = $wallRowRepresentation;
        }

        return implode("\n", array_reverse($wallRows));
    }

    public function equalsTo(Wall $wall): bool
    {
        return $this->wallNumerOfRows === $wall->wallNumerOfRows
            && $this->wallNumberOfBricksPerRow === $wall->wallNumberOfBricksPerRow;
    }
}
