<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('category_id');
            // $table->unsignedBigInteger('author_id');
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->text('short_description');
            $table->longText('description')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('price', 19, 4)->default(0);
            $table->decimal('discount_price', 19, 4)->default(0);
            $table->date('publish_date')->nullable();
            $table->string('publishing_house')->nullable();
            $table->string('avatar');
            $table->timestamps();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('author_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
