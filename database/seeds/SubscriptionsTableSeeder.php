<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscriptions')->insert([
            [
                'id' => 1,
                'customer_id' => 2,
                'start_date' => '2019-08-01',
                'next_order_date' => '2020-01-16',
                'day_iteration' => 30,
                'active' => false
            ],
            [
                'id' => 2,
                'customer_id' => 3,
                'start_date' => '2019-04-01',
                'next_order_date' => '2020-02-14',
                'day_iteration' => 40,
                'active' => true
            ],
            [
                'id' => 3,
                'customer_id' => 4,
                'start_date' => '2020-01-15',
                'next_order_date' => date('Y-m-d'),
                'day_iteration' => 20,
                'active' => true
            ]
        ]);
    }
}
