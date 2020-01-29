<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\SubscriptionsRepository;
use App\Models\Subscription;
use App\Models\Order;
use Log;

class CreateOrderFromIterationDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:place-next-order-date-today';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create orders based on subscriptions that have next order date set for today.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $nextOrderDate = date('Y-m-d');
        $subscriptions = SubscriptionsRepository::getActiveSubscriptionsByNextOrderDate($nextOrderDate);

        if (count($subscriptions) === 0)
        {
            return false;
        }

        Log::info(count($subscriptions).' subscription(s) found with next order date set for today: '.$nextOrderDate);

        foreach ($subscriptions as $subscription)
        {
            try {
                $order = new Order;
                $order->customer_id = $subscription->customer_id;
                $order->subscription_id = $subscription->id;
                $order->status = 'created';
                $order->total = 10; // Fixed, not defined from where to get this value.
                $order->save();

                if (!$order->id) {
                    throw new Exception();
                }

                $subscriptionRepository = new SubscriptionsRepository($subscription);
                $subscriptionRepository->updateNextOrderDateBasedOnDayIteration();

                Log::info('Order '.$order->id.' created successfully.');
            } catch (\Throwable $th) {
                Log::error('Error while trying to create order for user: '.$subscription->customer_id);
                Log::error($th->getMessage());
            }
        }

        return true;
    }
}
