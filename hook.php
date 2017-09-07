<?php
// Load composer
require __DIR__ . '/vendor/autoload.php';

// Load secret variables
include 'myVars.php';

try {
  $commands_paths = [
      __DIR__ . '/Commands',
  ];
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    // Handle telegram webhook request
    $telegram->handle();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // Silence is golden!
    // log telegram errors
    // echo $e->getMessage();
}
