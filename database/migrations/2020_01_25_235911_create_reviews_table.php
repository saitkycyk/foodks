<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('food_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('restaurant_id')->nullable();
            $table->integer('rate')->nullable();
            $table->text('review')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('food_id')
            ->references('id')
            ->on('foods');

            $table->foreign('user_id')
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
        Schema::dropIfExists('reviews');
    }
}
