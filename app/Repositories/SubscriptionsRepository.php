<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Subscription;
use DB;

class SubscriptionsRepository extends Repository
{
    public function setDayIteration(int $day_iteration)
    {
        $this->model->day_iteration = $day_iteration;
        $this->model->save();

        return $this->model;
    }

    public function updateNextOrderDateBasedOnDayIteration()
    {
        $nextOrderDate = new \DateTime($this->model->next_order_date);
        $nextOrderDate->modify('+'. $this->model->day_iteration .' day');

        $this->model->next_order_date = $nextOrderDate->format('Y-m-d');
        $this->model->save();

        return $this->model;
    }

    static function getActiveSubscriptionsByNextOrderDate($nextOrderDate)
    {
        return Subscription::select('id', 'next_order_date', 'day_iteration', 'customer_id')
            ->with(['customer' => function ($query) {
                return $query->select('id', 'name');
            }])
            ->where([
                [ 'active', true ],
                [ 'next_order_date', $nextOrderDate ]
            ])->get();
    }
}
