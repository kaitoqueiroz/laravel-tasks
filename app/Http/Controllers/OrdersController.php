<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use DB;
use App\Repositories\OrdersRepository;

class OrdersController extends Controller
{
    protected $ordersRepository;

    public function __construct(Order $model)
    {
        $this->ordersRepository = new OrdersRepository($model);
    }
    public function index()
    {
        return Order::all();
    }

    public function create(Order $order)
    {
        $order = $this->ordersRepository->create();

        return $order;
    }
}
