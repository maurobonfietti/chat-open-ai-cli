<?php

declare(strict_types=1);

namespace src\Command;

use OpenAI\Responses\Completions\CreateResponse;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

abstract class Base extends Command
{
    protected function chat(
        InputInterface $input,
        OutputInterface $output
    ): void {
        $prompt = $this->prompt($input, $output);

        $model = $this->getModel($input);

        $answer = $this->askOpenAI($prompt, $model, 500);

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
        $model = 'text-davinci-003';
        if ($input->getOption('codex') === true) {
            $model = 'code-davinci-002';
        }

        return $model;
    }

    protected function askOpenAI(
        string $prompt,
        string $model,
        int $tokens
    ): CreateResponse {
        $apiKey = (string) getenv('OPEN_AI_SECRET_API_KEY');
        $client = \OpenAI::client($apiKey);

        return $client->completions()->create([
            'prompt' => $prompt,
            'model' => $model,
            'max_tokens' => $tokens,
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
