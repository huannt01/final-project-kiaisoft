<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            'category_id' => 1,
            'author_id' => 1,
            'name' => 'Sách giáo khoa toán cấp 1 lớp 1',
            'slug' => 'sach_giao_khoa_toan_cap_1_lop_1',
            'short_description' => 'Sách giáo khoa cơ bản dành cho học sinh lớp 1',
            'description' => 'Sách giáo khoa cơ bản dành cho học sinh lớp 1',
            'quantity' => 10,
            'price' => 12500,
            'discount_price' => 10000,
            'publish_date' => '2022/06/18',
            'publishing_house' => 'NXB Giáo dục',
            'avatar' => 'https://book.sachgiai.com/uploads/book/sach-giao-khoa-toan-1/sach-giao-khoa-toan-1-0.jpg',
        ]);
    }
}
