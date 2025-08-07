# ChatGPT from the CLI

:robot: Ask questions to ChatGPT from the CLI.

![alt text](multimedia/ScreenshotChatGpt5Cli.png "Screenshot: Chat using OpenAI API from CLI")

------

## GETTING STARTED:

> **Requires PHP 8.1+**

### Clone repository with git and install dependencies:

In your terminal execute:

```bash
git clone https://github.com/maurobonfietti/chat-open-ai-cli
cd chat-open-ai-cli
cp .env.example .env
composer install
```


### Configure your OpenAI API KEY:

Edit your `.env` file:

```
OPEN_AI_SECRET_API_KEY='Your-Open-AI-Secret-Api-Key-Goes-Here'
```


### Get your API KEY from OpenAI:

Create an account on **OpenAI** to get your **API KEY**.

#### Screenshot from OpenAI Platform:

<p align="left">
    <img src="multimedia/ScreenshotApiKey.png" width="400" alt="Screenshot: Get your API KEY from OPEN AI Platform.">
</p>

------


## USAGE:

Chat to OpenAI from CLI with this command:

```bash
php console chat
```


## OPTIONS:

To use OpenAI **GPT-5** API:

```bash
php console chat --gpt5
```


To use OpenAI **GPT-4** API:

```bash
php console chat --gpt4
```


Allow **multiline** with this command:

```bash
php console chat --multiline
```


Get help and more info:

```bash
php console chat --help
```


Check command version:

```bash
php console --version
```

> *I'm using the alias: `chat` equivalent to: `php console chat`*.


## DEMO:

:video_camera: :movie_camera: See the video on Youtube: [I ask the OpenAI API questions from the CLI.](https://youtu.be/DQvyp_vvxEQ)

https://user-images.githubusercontent.com/24535949/222997557-465e395e-be28-417c-be79-0b3710a30f67.mp4


## DEPENDENCIES:

- [openai-php/client](https://github.com/openai-php/client): Supercharged community PHP API client that allows you to interact with the Open AI API.
- [symfony/console](https://github.com/symfony/console): The Console component eases the creation of beautiful and testable command line interfaces.
- [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv): Loads environment variables from `.env` to `getenv()`, `$_ENV` and `$_SERVER` automagically.


## CONFIGURE YOUR OPEN AI ACCOUNT:

When you create your account on **OpenAI**, you can get some free credits (like 18 USD on credits -at the time of writing this-). You can set your prefered payment method (Credit Card for instance).

#### Screenshot from OpenAI Platform:

<p align="left">
    <img src="multimedia/ScreenshotPayment.png" width="200" alt="Screenshot: Payment Method: Credit Card.">
</p>

------

Also, you can set and configure the usage limits (Hard Limit and Soft Limit).

#### Screenshot from OpenAI Platform:

![alt text](multimedia/ScreenshotLimits.png "Screenshot: Usage Limits.")

------

#### Screenshot from OpenAI Platform:

![alt text](multimedia/ScreenshotUsage.png "Account Usage Stats.")

------


## HELPFUL EXTERNAL LINKS:

https://openai.com/api/pricing/

https://platform.openai.com/tokenizer

https://platform.openai.com/account/usage

https://platform.openai.com/docs/quickstart/adjust-your-settings

https://platform.openai.com/docs/models/finding-the-right-model


## LICENSE:

:page_facing_up: The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat


## WOULD YOU LIKE TO SUPPORT THIS PROJECT?

:heart: You can support this project inviting me a coffee :coffee: :yum: or giving a **star** to this repo :star: :blush:.

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/maurobonfietti)


## THAT'S IT!

:partying_face: Now go and ask interesting questions to **ChatGPT** from the CLI :computer: :robot:.
