<?php

namespace App\Http\Controllers;

use App\Helpers\Telegram;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    protected $telegram;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Telegram $telegram, $event)
    {
        $this->telegram = $telegram;

        $public = explode('|', $request->input('callback_query')['data'])[0];
        $secred_key = explode('|', $request->input('callback_query')['data'])[1];
        $order = Order::where('secret_key', $secred_key)->first();

        if ($public == 1) {
            $acceptButtonText = '✅ Accept order';
            $refuseButtonText = 'Refuse';
        } else {
            $acceptButtonText = 'Accept order';
            $refuseButtonText = '✅ Refuse';
        }

        $reply_markup = [
            'inline_keyboard' => [
                [
                    [
                        'text' => $acceptButtonText,
                        'callback_data' => '1|' . $order->secret_key,
                    ],
                    [
                        'text' => $refuseButtonText,
                        'callback_data' => '0|' . $order->secret_key,
                    ],
                ]
            ]
        ];

        $data = [
            'id' => $event->order->id,
            'name' => $event->order->name,
            'email' => $event->order->email,
            'product' => $event->order->product,
        ];

        $reply_markup_encoded = json_encode($reply_markup);

        $messageId = $request->input('callback_query')['message']['message_id'];
        Log::info('Message ID: ' . $messageId);

        $this->telegram->editButtons(env('REPORT_TELEGRAM_ID'), (string)view('pages.messages.new_order', $data), $reply_markup_encoded, $messageId);

        $order->public = $public;
        $order->save();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
