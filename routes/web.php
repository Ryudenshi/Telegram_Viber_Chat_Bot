<?php

use App\Helpers\Telegram;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use app\Http\Controllers\TelegramViberBotController;
use App\Http\Controllers\WebhookController;
use App\Models\Order;

$ngrokForwardingUrl = 'https://f1ab-185-12-142-85.ngrok-free.app/Telegram_Viber_Chat_Bot/public/webhook';

Route::get('/', function(Order $order) use ($ngrokForwardingUrl) {
    //$http = Http::get('https://api.tlgr.org/bot6097503862:AAHdE6EKpMaXx_MDpo3-7Cz9P2PBLDc_XRs/setWebhook?url=' . $ngrokForwardingUrl);
    //dd(json_decode($http->body()));
    return view('pages.order', ['orders' => $order->active()->get()]);
});

Route::group(['namespace' => 'App\Http\Controllers'], function(){
    Route::post('/order/store', 'OrderController@Store')->name('order.store');
    Route::post('/webhook', [WebhookController::class, 'index']);
});