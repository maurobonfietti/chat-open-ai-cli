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
            ->setDescription('Ask questions to ChatGPT from the CLI.')
            ->addOption(
                'gpt4',
                '4',
                InputOption::VALUE_NONE,
                'Use the OpenAI GPT-4 API model: "gpt-4-0314" (instead of using the default model: "gpt-3.5-turbo-0301").',
                null
            )
            ->addOption(
                'multiline',
                'm',
                InputOption::VALUE_NONE,
                'Allow multiline text. Helpful to write text with multiple lines on the terminal. You should confirm the end-of-transmission: Ctrl-D on Unix systems or Ctrl-Z on Windows.',
                null
            )
        ;
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $output->writeln([
            '===============================================',
            '<info>Welcome! Ask questions to ChatGPT from the CLI:</info>',
            '===============================================',
            '',
        ]);

        while (true) {
            $this->chat($input, $output);
        }
    }
}
