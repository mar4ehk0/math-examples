<?php

namespace App\Domain\MathExample\Service\Document;

interface DocumentInterface
{
    public function setHtml(string $html): void;
    public function save(string $pathToFile): void;
}
