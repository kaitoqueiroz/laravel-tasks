<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Events\OrderPaid;

class OrdersController extends Controller
{
    public function index()
    {
        return Order::all();
    }

    public function setToPaid($orderId)
    {
        $order = Order::findOrFail($orderId);

        $order->status = 'paid';
        $order->paid_date = date('Y-m-d');
        $order->save();

        event(new OrderPaid($order));

        return $order;
    }
}
