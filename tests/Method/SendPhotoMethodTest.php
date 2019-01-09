<?php

declare(strict_types=1);

namespace TgBotApi\BotApiBase\Tests\Method;

use TgBotApi\BotApiBase\BotApi;
use TgBotApi\BotApiBase\Method\Interfaces\HasParseModeVariableInterface;
use TgBotApi\BotApiBase\Method\SendPhotoMethod;
use TgBotApi\BotApiBase\Tests\Method\Traits\InlineKeyboardMarkupTrait;
use TgBotApi\BotApiBase\Type\InputFileType;

class SendPhotoMethodTest extends MethodTestCase
{
    use InlineKeyboardMarkupTrait;

    /**
     * @throws \TgBotApi\BotApiBase\Exception\BadArgumentException
     * @throws \TgBotApi\BotApiBase\Exception\ResponseException
     * @throws \TgBotApi\BotApiBase\Exception\NormalizationException
     */
    public function testEncode()
    {
        $this->getApi()->sendPhoto($this->getMethod());
        $this->getApi()->send($this->getMethod());
    }

    /**
     * @return BotApi
     */
    private function getApi(): BotApi
    {
        return $this->getBotWithFiles(
            'sendPhoto',
            [
                'chat_id' => 'chat_id',
                'photo' => 'photo',

                'caption' => 'caption',
                'parse_mode' => HasParseModeVariableInterface::PARSE_MODE_MARKDOWN,

                'disable_notification' => true,
                'reply_to_message_id' => 1,
                'reply_markup' => $this->buildInlineMarkupArray(),
            ],
            ['photo' => true],
            ['reply_markup']
        );
    }

    /**
     * @throws \TgBotApi\BotApiBase\Exception\BadArgumentException
     *
     * @return SendPhotoMethod
     */
    private function getMethod(): SendPhotoMethod
    {
        return SendPhotoMethod::create(
            'chat_id',
            InputFileType::create('/dev/null'),
            [
                'caption' => 'caption',
                'parseMode' => HasParseModeVariableInterface::PARSE_MODE_MARKDOWN,

                'disableNotification' => true,
                'replyToMessageId' => 1,
                'replyMarkup' => $this->buildInlineMarkupObject(),
            ]
        );
    }
}
