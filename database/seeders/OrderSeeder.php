<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'user_id' => 1,
            'coupon_id' => 1,
            'name_receicer' => 'Huân',
            'phone_receicer' => '098459456',
            'shipping_address' => 'Hà Nội',
            'vat' => 5000,
            'fee' => 10000,
            'total_price' => 100000,
        ]);
    }
}
