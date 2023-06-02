<?php

use App\Helpers\Telegram;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use app\Http\Controllers\TelegramViberBotController;

Route::get('/', function (Telegram $telegram) {
    $buttons = [
        'inline_keyboard' => [
            [
                [
                    'text' => 'button4',
                    'callback_data' => '1'
                ],
                [
                    'text' => 'button2',
                    'callback_data' => '2'
                ],
            ]
        ]
    ];

    $sendMessage = $telegram->editButtons(436481135, 'test2', json_encode($buttons), 29);
    $sendMessage = json_decode($sendMessage);
    dd($sendMessage);
});

/*Route::get('/', function (Telegram $telegram) {
    $sendMessage = $telegram->sendMessage(436481135, 'test');
    $sendMessage = json_decode($sendMessage);
    $http = $telegram->sendDocument(436481135, 'Slider.png', $sendMessage->result->message);
    dd($http->body());
});*/