<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('lastname')->nullable();
            $table->boolean('restaurant')->default(false);
            $table->boolean('door_payment')->default(true);
            $table->boolean('card_payment')->default(false);
            $table->text('preferences')->nullable();
            $table->string('email')->unique();
            $table->string('picture')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            // $table->string('works')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('road_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('city_id')
            ->references('id')
            ->on('cities');

            $table->foreign('road_id')
            ->references('id')
            ->on('roads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
