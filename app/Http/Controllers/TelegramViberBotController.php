<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TelegramViberBotController extends Controller
{

    public function handleWebhook(Request $request)
    {
        // Handle the incoming webhook request from Telegram
        // Add your logic here to process the incoming message or update

        // Return a response to acknowledge receipt of the webhook request
        return response()->json(['status' => 'success']);
    }

    public function handleIncomingMessage(Request $request)
    {
        $message = $request->input('message');
        $chatId = $message['chat']['id'];
        $text = $message['text'];

        $this->sendMessage($chatId, 'This is your response message');
    }

    private function sendMessage($chatId, $message)
    {
        $client = new Client(['base_uri' => 'https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/']);
        $client->post('sendMessage', [
            'json' => [
                'chat_id' => $chatId,
                'text' => $message,
            ],
        ]);
    }
}
