<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupons')->insert([
            'name' => 'Mã giảm giá dành cho học sinh',
            'discount' => 10,
            'limit' => 1000,
            'code' => 'STUDENT',
            'description' => 'Giảm giá 10% các loại sách giáo khoa cho học sinh'
        ]);
    }
}
