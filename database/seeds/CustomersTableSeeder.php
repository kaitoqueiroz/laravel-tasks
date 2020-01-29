<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            [
                'id' => 1,
                'name' => 'Bruce Wayne',
                'email' => 'bruce@boldking.com',
                'active' => true
            ],
            [
                'id' => 2,
                'name' => 'Diana Prince',
                'email' => 'diana@boldking.com',
                'active' => true
            ],
            [
                'id' => 3,
                'name' => 'Tony Stark',
                'email' => 'tony@boldking.com',
                'active' => true
            ],
            [
                'id' => 4,
                'name' => 'Peter Parker',
                'email' => 'peter@boldking.com',
                'active' => true
            ]
        ]);
    }
}
