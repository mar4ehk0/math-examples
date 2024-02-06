<?php

namespace App\Domain\MathExample\Model;

class MathExample
{
    public function __construct(private int $a, private int $b, private string $operator)
    {
    }

    public function getA(): int
    {
        return $this->a;
    }

    public function getB(): int
    {
        return $this->b;
    }

    public function getOperator(): string
    {
        return $this->operator;
    }
}
