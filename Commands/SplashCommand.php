<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use GuzzleHttp;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;
use GuzzleHttp\Client;

new GuzzleHttp\Client();
$giveMeMyImage = new GuzzleHttp\Client(['base_uri' => $randomUrl]);

function randomImage(){
  $randomUrl = 'https://api.unsplash.com/photos/random?client_id=035477735402c0fde63a6cc7c2da69f6d55760b331b39e62f68a84260b460b4a';
  $response = $giveMeMyImage->request('GET', '');
  $temp = $response->getBody();
  $json = json_decode($temp, true);
  // var_dump($json); // Json check
  $imageUrl = $json['links']['download'];
  // echo $imageUrl; // url check
  return $imageUrl;
};

class SplashCommand extends UserCommand{
  protected $name = 'splash';                      // Your command's name
  protected $description = 'Get an high quality photo'; // Your command description
  protected $usage = '/splash';                    // Usage of your command
  protected $version = '1.0.0';                  // Version of your command


public function execute()
    {
        $message = $this->getMessage();            // Get Message object


        $chat_id = $message->getChat()->getId();   // Get the current Chat ID

        $data = [
        'chat_id' => $chat_id,
        'photo'   => randomImage(),
        'caption' => 'Caption'
        ];

        return Request::sendPhoto($data);        // Send message!
    }
}
