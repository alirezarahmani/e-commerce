<?php

declare(strict_types=1);

namespace App\ValueObjects;

use Assert\Assertion;

abstract class StringValueObject
{
    public function __construct(protected string $value)
    {
        Assertion::notEmpty($this->value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
