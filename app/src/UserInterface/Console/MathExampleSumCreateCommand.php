<?php

namespace App\UserInterface\Console;

use App\UseCase\CreatorMathExamplesPage;
use App\UseCase\DTO;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:example-sum')]
class MathExampleSumCreateCommand extends Command
{
    private const SUM = 'sum';
    private const OPERATOR = '+';
    private const MIN = 0;
    private const MAX = 1000;

    public function __construct(private readonly CreatorMathExamplesPage $creatorMathExamplesPage)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument(
            self::SUM,
            InputArgument::REQUIRED,
            'Сумма'
        );
    }

    public function interact(InputInterface $input, OutputInterface $output): void
    {
        $sum = $input->getArgument(self::SUM);
        if ($sum < self::MIN || $sum > self::MAX) {
            $output->writeln(sprintf('Значение должно быть больше %d и меньше %d', self::MIN, self::MAX));
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $sum = $input->getArgument(self::SUM);
        $this->creatorMathExamplesPage->handle(new DTO(self::OPERATOR, $sum));

        return self::SUCCESS;
    }
}
