<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use DB;

class OrdersController extends Controller
{
    public function index()
    {
        return Order::all();
    }
}
