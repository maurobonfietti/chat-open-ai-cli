<?php

declare(strict_types=1);

namespace src\Command;

use OpenAI\Responses\Chat\CreateResponse;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

abstract class Base extends Command
{
    protected $messages = [];

    protected function chat(
        InputInterface $input,
        OutputInterface $output
    ): void {
        $prompt = $this->prompt($input, $output);

        $this->messages[] = ['role' => 'user', 'content' => $prompt];

        $model = $this->getModel($input);

        $answer = $this->askOpenAI($model, 500);

        $this->writeAnswer($output, $answer);

        $this->writeTotalTokens($output, $answer);
    }

    protected function prompt(
        InputInterface $input,
        OutputInterface $output
    ): string {
        /** @var QuestionHelper $questionHelper */
        $questionHelper = $this->getHelper('question');

        $question = new Question('<info>> </info>');
        if ($input->getOption('multiline') === true) {
            $question->setMultiline(true);
            $output->writeln([
                '<comment>[multiline:]</comment> true',
                '',
            ]);
        }

        do {
            $prompt = $questionHelper->ask($input, $output, $question);
        } while ($prompt === null || $prompt === '');

        return $prompt;
    }

    protected function getModel(InputInterface $input): string
    {
        $model = 'gpt-3.5-turbo';
        if ($input->getOption('gpt4') === true) {
            $model = 'gpt-4o-mini';
        }

        return $model;
    }

    protected function askOpenAI(
        string $model,
        int $tokens
    ) {
        $apiKey = (string) getenv('OPEN_AI_SECRET_API_KEY');
        $client = \OpenAI::client($apiKey);

        return $client->chat()->create([
            'model' => $model,
            'messages' => $this->messages,
            'max_tokens' => $tokens,
        ]);
    }

    protected function writeAnswer(
        OutputInterface $output,
        CreateResponse $answer
    ): void {

        $this->messages[] = [
            'role' => 'assistant',
            'content' => $answer['choices'][0]['message']['content']
        ];

        $output->writeln([
            '',
            '',
            trim($answer['choices'][0]['message']['content']),
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
