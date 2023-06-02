<?php

use App\Helpers\Telegram;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use app\Http\Controllers\TelegramViberBotController;

Route::post('/telegram/webhook', 'TelegramViberBotController@handleIncomingMessage');

Route::post('/telegram/webhook', 'TelegramViberBotController@handleWebhook');

Route::get('/', function (Telegram $telegram) {
    $sendMessage = $telegram->sendMessage(436481135, 'test');
    $sendMessage = json_decode($sendMessage);
    $http = $telegram->sendDocument(436481135, 'Slider.png', $sendMessage->result->message_id);
    dd($http->body());
});