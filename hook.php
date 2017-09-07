<?php
// Load composer
require __DIR__ . '/vendor/autoload.php';

// Load secret variables
include 'myVars.php';

$commands_paths = [
    __DIR__ . '/Commands/',
];

try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
    $telegram->
    // Handle telegram webhook request
    $telegram->handle();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // Silence is golden!
    // log telegram errors
    // echo $e->getMessage();
}
TelegramLog::initErrorLog($path . '/' . $BOT_NAME . '_error.log');
TelegramLog::initDebugLog($path . '/' . $BOT_NAME . '_debug.log');
TelegramLog::initUpdateLog($path . '/' . $BOT_NAME . '_update.log');
