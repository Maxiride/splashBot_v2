<?php
// Load composer
require __DIR__ . '/vendor/autoload.php';

// Load secret variables
include 'myVars.php';

// Check if the connection comes from the Telegram Servers
// Set the lower and upper limit of valid Telegram IPs.
// https://core.telegram.org/bots/webhooks#the-short-version
$telegram_ip_lower = '149.154.167.197';
$telegram_ip_upper = '149.154.167.233';

// // Get the real IP.
// $ip = $_SERVER['REMOTE_ADDR'];
// foreach (['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR'] as $key) {
//     $addr = @$_SERVER[$key];
//     if (filter_var($addr, FILTER_VALIDATE_IP)) {
//         $ip = $addr;
//     }
// }
//
// // Make sure the IP is valid.
// $lower_dec = (float) sprintf("%u", ip2long($telegram_ip_lower));
// $upper_dec = (float) sprintf("%u", ip2long($telegram_ip_upper));
// $ip_dec    = (float) sprintf("%u", ip2long($ip));
// if ($ip_dec < $lower_dec || $ip_dec > $upper_dec) {
//     die("Hmm, I don't trust you...");
// }


// Secret check
if (!isset($_GET['secret']) || $_GET['secret'] !== $secret) {
    die("I'm safe =)");
}

// Path to Commands
$commands_paths = [
    __DIR__ . '/Commands/',
];

try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    $telegram->addCommandsPaths($commands_paths);

    // Logging (Error, Debug and Raw Updates)
    // Longman\TelegramBot\TelegramLog::initErrorLog(__DIR__ . "/{$bot_username}_error.log");
    // Longman\TelegramBot\TelegramLog::initDebugLog(__DIR__ . "/{$bot_username}_debug.log");
    // Longman\TelegramBot\TelegramLog::initUpdateLog(__DIR__ . "/{$bot_username}_update.log");

    // Handle telegram webhook request
    $telegram->handle();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // Silence is golden!
    // log telegram errors
    // echo $e->getMessage();
}
