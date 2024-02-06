<?php

namespace App\UseCase;

readonly class DTO
{
    public function __construct(public string $operator, public int $value)
    {
    }
}
