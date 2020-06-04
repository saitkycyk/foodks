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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('food_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('restaurant_id');
            $table->unsignedBigInteger('order_group_id')->nullable();
            $table->json('ingredients')->nullable();
            $table->integer('quantity')->nullable()->default(1);
            $table->integer('price')->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('food_id')
            ->references('id')
            ->on('foods');

            $table->foreign('user_id')
            ->references('id')
            ->on('users');

            $table->foreign('restaurant_id')
            ->references('id')
            ->on('users');
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
