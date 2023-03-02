<?php

declare(strict_types=1);

namespace src\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

final class AskOpenAI extends Base
{
    protected function configure(): void
    {
        $this
            ->setName('chat')
            ->setDescription('Ask questions to OpenAI API from the CLI.')
            ->addOption(
                'multiline',
                'm',
                InputOption::VALUE_NONE,
                'Allow multiline text. Helpful to write text with multiple lines on the terminal. You should confirm the End Of File with "ctrl+d".',
                null
            )
        ;
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $output->writeln([
            '==========================================',
            '<info>Welcome! Ask your questions to OpenAI API:</info>',
            '==========================================',
            '',
        ]);

        while (true) {
            $this->chat($input, $output);
        }
    }
}
