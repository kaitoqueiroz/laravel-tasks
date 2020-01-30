<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('orders')->insert([
            [
                'id' => 1,
                'customer_id' => 2,
                'subscription_id' => 1,
                'status' => 'failed',
                'total' => 50,
                'paid_date' => null
            ],
            [
                'id' => 2,
                'customer_id' => 1,
                'subscription_id' => null,
                'status' => 'paid',
                'total' => 100,
                'paid_date' => '2020-01-03'
            ],
            [
                'id' => 3,
                'customer_id' => 3,
                'subscription_id' => 2,
                'status' => 'paid',
                'total' => 10,
                'paid_date' => '2020-01-04'
            ],
            [
                'id' => 4,
                'customer_id' => 2,
                'subscription_id' => null,
                'status' => 'paid',
                'total' => 20,
                'paid_date' => '2020-01-04'
            ],
            [
                'id' => 5,
                'customer_id' => 4,
                'subscription_id' => 3,
                'status' => 'created',
                'total' => 30,
                'paid_date' => null
            ]
        ]);
    }
}
