<?php

declare(strict_types=1);

namespace RadigarHub\BuildAWall\Wall\Domain\Model;

class TooManyBricksException extends \DomainException
{
    public function __construct(string $message = "Naah, too much...here's my resignation.")
    {
        parent::__construct($message);
    }
}
