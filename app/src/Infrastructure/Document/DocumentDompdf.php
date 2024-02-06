<?php

namespace App\Infrastructure\Document;


use App\Domain\MathExample\Service\Document\DocumentInterface;
use Dompdf\Dompdf;

class DocumentDompdf implements DocumentInterface
{
    public function __construct(private readonly Dompdf $dompdf)
    {
        $dompdf->setPaper('A4', 'landscape');
    }

    public function setHtml(string $html): void
    {
        $this->dompdf->loadHtml($html);
    }

    public function save(string $pathToFile): void
    {
        $this->dompdf->render();
        $output = $this->dompdf->output();

        file_put_contents($pathToFile, $output);
    }
}
