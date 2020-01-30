<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Delivery;
use DB;

class DeliveriesRepository extends Repository
{
    public function createNewDeliveryForOrder(Order $order)
    {
        $delivery = new Delivery();
        $delivery->order_id = $order->id;
        $delivery->address = 'some address'; // define how to get the address
        $delivery->status = 'created';

        $delivery->save();

        return $delivery;
    }
}
