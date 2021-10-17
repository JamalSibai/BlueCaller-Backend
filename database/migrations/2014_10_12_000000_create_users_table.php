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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->text('image')->nullable();
            $table->boolean('user_type');///0 => client//1 => freelancer
            $table->text('firebase_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('freelancers', function (Blueprint $table) {
            $table->id();
            $table->integer('hourly_price');
            $table->string('category_id');
            $table->string('user_id');
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->timestamps();
        });

        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('region');
            $table->timestamps();
        });

        Schema::create('freelancers_has_regions', function (Blueprint $table) {
            $table->id();
            $table->string('region_id');
            $table->string('user_id');
            $table->timestamps();
        });

        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->date('date_of_day');
            $table->boolean('availability'); ///0-> available///1-> full
            $table->timestamps();
        });

        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('calendar_id');
            $table->integer('user_id');
            $table->string('longitude');
            $table->string('latitude');
            $table->text('description');
            $table->boolean('status');//  0 for in progress //1 for done
            $table->timestamps();
        });

        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_rating');
            $table->integer('rated_user');
            $table->integer('ratings');
            $table->timestamps();
        });

        Schema::create('connections', function (Blueprint $table) {
            $table->id();
            $table->integer('user1');
            $table->integer('user2');
            $table->timestamps();
        });


        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->integer('sender_id');
            $table->integer('receiver_id');
            $table->text('message');
            $table->timestamps();
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
        Schema::dropIfExists('freelancers');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('regions');
        Schema::dropIfExists('freelancers_has_regions');
        Schema::dropIfExists('calendars');
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('ratings');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('connections');
    }
}
