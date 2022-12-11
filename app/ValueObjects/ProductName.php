<?php

declare(strict_types=1);

namespace App\ValueObjects;

use Assert\Assertion;

class ProductName extends StringValueObject
{
    public function __construct(protected string $value)
    {
        Assertion::notEmpty($this->value, 'product name should NOT be empty');
        // It can be business rule
        // Assertion::alnum($this->value, 'Only alphaNum is allowed in product name');
        parent::__construct($this->value);
    }

    public function value(): string
    {
        return $this->value;
    }

}
