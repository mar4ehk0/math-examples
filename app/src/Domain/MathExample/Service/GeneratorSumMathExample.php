<?php

namespace App\Domain\MathExample\Service;

use App\Domain\MathExample\Model\MathExample;

class GeneratorSumMathExample implements GeneratorMathExampleInterface
{
    private const OPERATOR = '+';
    public function __construct(private readonly int $resultValue)
    {

    }

    /**
     * @return MathExample[]
     */
    public function generateExamples(): array
    {
        $excludeNums = [0];

        $mathExamples = [];
        for ($a = 0; $a < $this->resultValue; $a++) {
            if (in_array($a, $excludeNums)) {
                continue;
            }
            for ($b = 0; $b < $this->resultValue; $b++) {
                if (in_array($b, $excludeNums)) {
                    continue;
                }
                if ($a + $b <= $this->resultValue) {
                    $mathExamples[] = new MathExample($a, $b, self::OPERATOR);
                }
            }
        }
        return $mathExamples;
    }
}
