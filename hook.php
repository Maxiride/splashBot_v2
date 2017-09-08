<?php
// Load composer
require __DIR__ . '/vendor/autoload.php';

// Load secret variables
include 'myVars.php';

// // Check if the connection comes from the Telegram Servers
// // Set the lower and upper limit of valid Telegram IPs.
// // https://core.telegram.org/bots/webhooks#the-short-version
// $telegram_ip_lower = '149.154.167.197';
// $telegram_ip_upper = '149.154.167.233';
//
// // Get the real IP.
// $ip = $_SERVER['REMOTE_ADDR'];
// foreach (['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR'] as $key) {
//     $addr = @$_SERVER[$key];
//     if (filter_var($addr, FILTER_VALIDATE_IP)) {
//         $ip = $addr;
//     }
// }

// // Make sure the IP is valid.
// $lower_dec = (float) sprintf("%u", ip2long($telegram_ip_lower));
// $upper_dec = (float) sprintf("%u", ip2long($telegram_ip_upper));
// $ip_dec    = (float) sprintf("%u", ip2long($ip));
// if ($ip_dec < $lower_dec || $ip_dec > $upper_dec) {
//     die("Hmm, I don't trust you...");
// }


// // Secret check
// if (!isset($_GET['secret']) || $_GET['secret'] !== $secret) {
//     die("I'm safe =)");
// }


// Define all IDs of admin users in this array (leave as empty array if not used)
$admin_users = [
//    123,
];

// Define all paths for your custom commands in this array (leave as empty array if not used)
$commands_paths = [
  __DIR__ . '/Commands/',
];

// Enter your MySQL database credentials
//$mysql_credentials = [
//    'host'     => 'localhost',
//    'user'     => 'dbuser',
//    'password' => 'dbpass',
//    'database' => 'dbname',
//];

try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    // Add commands paths containing your custom commands
    $telegram->addCommandsPaths($commands_paths);

    // Enable admin users
    $telegram->enableAdmins($admin_users);

    // Enable MySQL
    //$telegram->enableMySql($mysql_credentials);

    // Logging (Error, Debug and Raw Updates)
    // Longman\TelegramBot\TelegramLog::initErrorLog(__DIR__ . "/{$bot_username}_error.log");
    // Longman\TelegramBot\TelegramLog::initDebugLog(__DIR__ . "/{$bot_username}_debug.log");
    // Longman\TelegramBot\TelegramLog::initUpdateLog(__DIR__ . "/{$bot_username}_update.log");

    // If you are using a custom Monolog instance for logging, use this instead of the above
    //Longman\TelegramBot\TelegramLog::initialize($your_external_monolog_instance);

    // Set custom Upload and Download paths
    //$telegram->setDownloadPath(__DIR__ . '/Download');
    //$telegram->setUploadPath(__DIR__ . '/Upload');

    // Here you can set some command specific parameters
    // e.g. Google geocode/timezone api key for /date command
    //$telegram->setCommandConfig('date', ['google_api_key' => 'your_google_api_key_here']);

    // Botan.io integration
    //$telegram->enableBotan('your_botan_token');

    // Requests Limiter (tries to prevent reaching Telegram API limits)
    $telegram->enableLimiter();

    // Handle telegram webhook request
    $telegram->handle();

} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // Silence is golden!
    //echo $e;
    // Log telegram errors
    Longman\TelegramBot\TelegramLog::error($e);
} catch (Longman\TelegramBot\Exception\TelegramLogException $e) {
    // Silence is golden!
    // Uncomment this to catch log initialisation errors
    //echo $e;
}
