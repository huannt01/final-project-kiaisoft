<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default(0)->comment("0: Pending, 1: Payment Success, 2: Process, 3: Delivered, 4: Cancel");
            $table->string('name_receicer', 50);
            $table->string('phone_receicer', 20);
            $table->string('shipping_address');
            $table->decimal('vat', 19, 4)->default(0);
            $table->decimal('fee', 19, 4)->default(0);
            $table->decimal('discount', 19, 4)->default(0);
            $table->decimal('total_price', 19, 4)->default(0);
            $table->timestamps();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('coupon_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
