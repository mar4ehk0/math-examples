<?php

namespace App\UseCase;

use App\Domain\MathExample\Service\Document\DocumentInterface;
use App\Domain\MathExample\Service\Render\RenderInterface;
use App\Infrastructure\Factory\FactoryGenerator;

class CreatorMathExamplesPage
{
    public function __construct(
        private RenderInterface $render,
        private DocumentInterface $document,
        private readonly FactoryGenerator $factoryGenerator
    ) {

    }

    public function handle(DTO $DTO): void
    {
        $generator = $this->factoryGenerator->generate($DTO->operator, $DTO->value);

        $mathExamples = $generator->generateExamples();
        shuffle($mathExamples);

        $html = $this->render->render('Math/math.html.twig', $mathExamples);

        $this->document->setHtml($html);
        $this->document->save($this->createFullPathPath(SRC_PATH . '../'));
    }

    private function createFullPathPath(string $rootPath): string
    {
        return sprintf('%s/%s.pdf', $rootPath, time());
    }
}
