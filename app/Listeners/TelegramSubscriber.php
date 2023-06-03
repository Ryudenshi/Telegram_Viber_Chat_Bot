<?php

namespace App\Listeners;

use App\Events\OrderStore;
use App\Helpers\Telegram;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TelegramSubscriber
{

    protected $telegram;

    public function __construct(Telegram $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * @param OrderStore $event
     * @return array
     */

    public function orderStore($event)
    {
        $data = [
            'id' => $event->order->id,
            'name' => $event->order->name,
            'email' => $event->order->email,
            'product' => $event->order->product,
        ];

        $reply_markup = [
            'inline_keyboard' => [
                [
                    [
                        'text' => 'Accept order',
                        'callback_data' => '1|' . $event->order->secret_key,
                    ],
                    [
                        'text' => 'Refuse',
                        'callback_data' => '0|' . $event->order->secret_key,
                    ],
                ]
            ]
        ];

        $reply_markup_encoded = json_encode($reply_markup);

        $this->telegram->sendButtons(env('REPORT_TELEGRAM_ID'), (string)view('pages.messages.new_order', $data), $reply_markup_encoded);
    }

    public function subscribe($events)
    {
        $events->listen(
            OrderStore::class,
            [
                TelegramSubscriber::class, 'orderStore'
            ]
        );
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        //
    }
}
