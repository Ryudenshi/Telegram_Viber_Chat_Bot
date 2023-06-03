<?php

namespace App\Http\Controllers;

use App\Events\OrderStore;
use App\Helpers\Telegram;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Order $order)
    {

        $key = base64_encode(md5(uniqid()));

        $order = $order->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'product' => $request->input('product'),
            'public' => false,
            'secret_key' => $key,
        ]);

        event(new OrderStore($order));

        return response()->redirectTo('/');
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
