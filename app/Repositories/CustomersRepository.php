<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use DB;

class CustomersRepository extends Repository
{
    public function withLastPaidOrder()
    {
        $customers = $this->model->select([
            'id',
            'name',
            'last_paid_order_date' => function ($query) {
                $query->select('paid_date')
                    ->from('orders')
                    ->whereColumn('customer_id', 'customers.id')
                    ->where('status', 'paid')
                    ->orderBy('paid_date', 'desc')
                    ->limit(1);
                return $query;
            }
        ])->get();

        return $customers;
    }

    public function withMoreThanOnePaidOrder()
    {
        $customers = $this->model->select([
            'id',
            'name',
            'paid_orders' => function ($query) {
                return $query->select(DB::raw('count(*) as total'))
                    ->from('orders')
                    ->whereColumn('customer_id', 'customers.id')
                    ->where('status', 'paid')
                    ->groupBy('customer_id');
            }
        ])
        ->groupBy('id')
        ->having('paid_orders', '>', 1)
        ->get();

        return $customers;
    }

    public function withActiveSubscriptionAndPaidOrder()
    {
        $customers = $this->model->select([
            'id',
            'name',
            'paid_orders' => function ($query) {
                return $query->select(DB::raw('count(*) as total'))
                    ->from('orders')
                    ->whereColumn('customer_id', 'customers.id')
                    ->where('status', 'paid')
                    ->groupBy('customer_id');
            }
        ])
        ->whereHas('subscriptions', function ($query) {
            return $query->where('active', 1);
        })
        ->having('paid_orders', '>', 0)
        ->get();

        return $customers;
    }
}
