<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use DB;

class OrdersRepository extends Repository
{
    public function create()
    {
        $order = new $this->model([
            'customer_id' => 1,
            'subscription_id' => 1,
            'status' => 'created',
            'total' => 10 // Fixed, not defined from where to get this value.
        ]);

        $order->save();

        return $order;
    }
}
