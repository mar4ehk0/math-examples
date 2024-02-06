<?php

namespace App\Infrastructure\Factory;

use App\Domain\MathExample\Exception\OperatorDoesNotSupportException;
use App\Domain\MathExample\Service\GeneratorMathExampleInterface;
use App\Domain\MathExample\Service\GeneratorSumMathExample;
use RuntimeException;

class FactoryGenerator
{
    public function generate(string $operator, int $resultValue): GeneratorMathExampleInterface
    {
        switch ($operator) {
            case '+': return new GeneratorSumMathExample($resultValue);
            case '-': throw new RuntimeException();
        }

        throw new OperatorDoesNotSupportException($operator);
    }
}
