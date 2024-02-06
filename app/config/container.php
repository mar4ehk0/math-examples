<?php

use App\Domain\MathExample\Service\Document\DocumentInterface;
use App\Domain\MathExample\Service\Render\RenderInterface;
use App\Infrastructure\Document\DocumentDompdf;
use App\Infrastructure\Factory\FactoryGenerator;
use App\Infrastructure\View\RenderTwig\RenderTwig;
use App\UseCase\CreatorMathExamplesPage;
use App\UserInterface\Console\MathExampleSumCreateCommand;
use Dompdf\Dompdf;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$containerBuilder = new ContainerBuilder();

// Twig
$containerBuilder->register(FilesystemLoader::class, FilesystemLoader::class)
    ->setArguments([TWIG_TEMPLATES_PATH]);
$containerBuilder->register(Environment::class, Environment::class)
    ->setArguments([
        new Reference(FilesystemLoader::class),
        [
            'cache' => VAR_CACHE_PATH,
            'debug' => getenv('TWIG_DEBUG'),
            'auto_reload' => getenv('TWIG_AUTO_RELOAD'),
            'optimizations' => getenv('TWIG_OPTIMIZATIONS')
        ]
    ]);

$containerBuilder->register(Dompdf::class, Dompdf::class);
$containerBuilder->register(DocumentInterface::class, DocumentDompdf::class)
    ->setArguments([
        new Reference(Dompdf::class),
    ]);

$containerBuilder->register(RenderInterface::class, RenderTwig::class)
    ->setArguments([
        new Reference(Environment::class),
    ]);

$containerBuilder->register(FactoryGenerator::class, FactoryGenerator::class);
$containerBuilder->register(CreatorMathExamplesPage::class, CreatorMathExamplesPage::class)
    ->setArguments([
        new Reference(RenderInterface::class),
        new Reference(DocumentInterface::class),
        new Reference(FactoryGenerator::class)
    ]);

$containerBuilder->register(MathExampleSumCreateCommand::class, MathExampleSumCreateCommand::class)
    ->setArguments([
        new Reference(CreatorMathExamplesPage::class)
    ]);

return $containerBuilder;
