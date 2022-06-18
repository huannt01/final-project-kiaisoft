<?php

namespace Database\Seeders;

use App\Models\Favourite;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            CategorySeeder::class,
            Book::class,
            Author::class,
            Coupon::class,
            Order::class,
            OrderDetail::class,
            Favourite::class,
            BookImage::class
        ]);
    }
}
