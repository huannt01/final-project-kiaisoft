<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('book_images')->insert([
            'book_id' => 1,
            'image_path' => 'https://blogtailieu.com/wp-content/uploads/2021/06/420_20200528090018_wm_shs-toan-ctst_tc-1.jpg',
        ]);
    }
}
