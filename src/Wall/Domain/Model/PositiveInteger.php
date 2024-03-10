<?php

declare(strict_types=1);

namespace RadigarHub\BuildAWall\Wall\Domain\Model;

readonly abstract class PositiveInteger
{
    private function __construct(public int $value)
    {
    }

    public static function create(int $value): static
    {
        self::validateIsPositiveInteger($value);

        return new static($value);
    }

    private static function validateIsPositiveInteger(int $value): void
    {
        if ($value <= 0) {
            throw new \InvalidArgumentException(static::message());
        }
    }

    abstract protected static function message(): string;

    public function equalsTo(PositiveInteger $positiveInteger): bool
    {
        return $this->value === $positiveInteger->value;
    }
}
