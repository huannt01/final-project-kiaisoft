<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'parent_id' => '1',
            'category_name' => 'Sách giáo khoa',
            'description' => 'Sách giáo khoa cơ bản cho học sinh tiểu học'
        ]);
    }
}
