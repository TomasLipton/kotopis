<?php

namespace App\Http\Controllers;

use App\Models\Footprint;
use App\Models\Media;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Messages\Attachments\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TelegramBotController extends Controller
{
    public function index()
    {
        $config = [
            // Your driver-specific configuration
            "telegram" => [
                "token" => "5651633567:AAHR-BaAdulqopu5YLtaPTKnySYyEbvWJi0"
            ]
        ];

// Load the driver(s) you want to use
        DriverManager::loadDriver(\BotMan\Drivers\Telegram\TelegramDriver::class);

// Create an instance
        $botman = BotManFactory::create($config);
        $botman->fallback(function ($bot) {
            $bot->reply('Sorry, I did not understand it. Пришли мне картинку :)');
        });
// Give the bot something to listen for.
        $botman->hears('Hi', function (BotMan $bot) {
            $bot->reply('Hello yourself.');
        });

        $botman->receivesImages(function ($bot, $images) {
            $bot->reply('Загрузка...');
            $bot->typesAndWaits(2);
            /** @var Image $image */
            $fp = Footprint::create([
                                        'user_id' => 1,
                                    ]);

            foreach ($images as $image) {
                $url = $image->getUrl(); // The direct url
                $title = $image->getTitle(); // The title, if available
                $payload = $image->getPayload(); // The original payload
//                $bot->reply('done');
//                $bot->reply('done');
//                $bot->reply('done');

                $f = file_get_contents($url);
                $s3path = '94f8849e-358a-45f5-82e6-2cce6d0d8cca/' . Str::uuid() . '.' . pathinfo($image->getUrl())['extension'];
                $storedMedia = Storage::disk('s3')->put($s3path, $f);

                Media::create([
                                  'path' => $s3path,
                                  'footprint_id' => $fp->id,
                              ]);

                $bot->reply('OK - check kotopis.avgust.dev');
            }
        });


// Start listening
        return $botman->listen();
    }
}
