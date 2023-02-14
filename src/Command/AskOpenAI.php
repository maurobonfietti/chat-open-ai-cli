<?php

declare(strict_types=1);

namespace src\Command;

use OpenAI\Responses\Completions\CreateResponse;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

final class AskOpenAI extends Command
{
    protected function configure(): void
    {
        $this
            ->setName('chat')
            ->setDescription('Ask questions to OpenAI API from the CLI.')
        ;
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $this->writeWelcomeMessage($output);

        while (true) {
            $this->chat($input, $output);
        }

        return Command::SUCCESS;
    }

    protected function writeWelcomeMessage(OutputInterface $output): void
    {
        $output->writeln([
            '==========================================',
            '<info>Welcome! Ask your questions to OpenAI API:</info>',
            '==========================================',
            '',
        ]);
    }

    protected function chat(
        InputInterface $input,
        OutputInterface $output
    ): void {
        $prompt = $this->prompt($input, $output);

        $answer = $this->askOpenAI($prompt);

        $this->writeAnswer($output, $answer);

        $this->writeTotalTokens($output, $answer);
    }

    protected function prompt(
        InputInterface $input,
        OutputInterface $output
    ): string {
        /** @var QuestionHelper $questionHelper */
        $questionHelper = $this->getHelper('question');

        $question = new Question('> ');
//        $question->setMultiline(true);

        do {
            $prompt = $questionHelper->ask($input, $output, $question);
        } while ($prompt === null || $prompt === '');

        return $prompt;
    }

    protected function askOpenAI(string $prompt): CreateResponse
    {
        $apiKey = (string) getenv('OPEN_AI_SECRET_API_KEY');
        $client = \OpenAI::client($apiKey);

        return $client->completions()->create([
            'prompt' => $prompt,
            'model' => 'text-davinci-003',
            'max_tokens' => 500,
        ]);
    }

    protected function writeAnswer(
        OutputInterface $output,
        CreateResponse $answer
    ): void {
        $output->writeln([
            '',
            '',
            trim($answer['choices'][0]['text']),
            '',
            '',
        ]);
    }

    protected function writeTotalTokens(
        OutputInterface $output,
        CreateResponse $result
    ): void {
        $totalTokens = $result->toArray()['usage']['total_tokens'];

        $output->writeln([
            '<comment>[Total Tokens:]</comment> ' . $totalTokens,
            '',
            '',
        ]);
    }
}
