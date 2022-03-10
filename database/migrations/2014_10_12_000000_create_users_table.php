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
            $table->id('user_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            $table->longText('address_one');
            $table->longText('address_two');
            $table->integer('province_id');
            $table->integer('regency_id');
            $table->integer('zip_code');
            $table->string('country');
            $table->string('phone');
            $table->string('store_name');
            $table->bigInteger('category_id')->unsigned();
            $table->string('store_status');

            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('category_id')->references('category_id')->on('categories');
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
