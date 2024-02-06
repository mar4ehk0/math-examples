<?php

namespace App\Domain\MathExample\Service\Render;

use App\Domain\MathExample\Model\MathExample;

interface RenderInterface
{
    public function render(string $templateName, array $mathExamples): string;
}
