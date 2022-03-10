<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            
            $table->bigInteger('user_id')->unsigned();
            $table->integer('insurance');
            $table->integer('shipping');
            $table->integer('total');
            $table->string('status'); // Unpaid/Pending/Shipping/Success/Cancel
            $table->integer('receipt');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
