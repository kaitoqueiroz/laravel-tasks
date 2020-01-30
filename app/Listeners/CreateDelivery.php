<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\OrderPaid;
use App\Repositories\DeliveriesRepository;
use App\Models\Delivery;

class CreateDelivery
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderPaid $event)
    {
        $delivery = new DeliveriesRepository(new Delivery);
        $delivery->createNewDeliveryForOrder($event->order);

        return true;
    }
}
