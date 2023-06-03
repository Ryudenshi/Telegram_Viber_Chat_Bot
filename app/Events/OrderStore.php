<?php

namespace App\Events;

use App\Models\Order;

class OrderStore
{
    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}
