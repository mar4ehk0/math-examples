<?php

namespace App\Infrastructure\View\RenderTwig;

use App\Domain\MathExample\Service\Render\RenderInterface;
use Twig\Environment;

class RenderTwig implements RenderInterface
{
    private const LIMIT_ROWS_PER_PAGE = 17;

    public function __construct(private Environment $twig)
    {
    }

    public function render(string $templateName, array $mathExamples): string
    {
        $chunks = array_chunk($mathExamples, self::LIMIT_ROWS_PER_PAGE);

        $leftColumn = $chunks[0];
        $rightColumn = array_key_exists(1, $chunks) ? $chunks[1]: [];

        return $this->twig->render($templateName, ['left_column' => $leftColumn, 'right_column' => $rightColumn]);
    }
}
