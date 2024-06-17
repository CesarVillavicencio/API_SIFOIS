<?php

namespace App\Helpers;

use Telegram\Bot\Api as TelegramApi;
use Telegram\Bot\Exceptions\TelegramResponseException;
use Log;

class TelegramHelper {
    public $telegram;
    public $chatId;
    public $on;

    public function __construct() {
        $this->telegram = new TelegramApi(env('TELEGRAM_BOT_TOKEN'));
        $this->chatId = env('TELEGRAM_GRL_CHAT_ID');
        $this->on = env('TELEGRAM_BOT_ON', false);
    }

    public function sendMessage(string $message) {
        if (! $this->on) { return false; }
        try {
            $response = $this->telegram->sendMessage([
                "chat_id" => $this->chatId,
                "text" => $message
            ]);
        } catch (TelegramResponseException $e) {
            Log::info($e->getMessage());
            return false;
        }

        return $response;
    }

    public function getUpdates() {
        return $this->telegram->getUpdates();
    }
}