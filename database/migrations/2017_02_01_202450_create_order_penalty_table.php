<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderPenaltyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('orders_penalty', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('payment_method_id')->unsigned();
            $table->integer('reference')->unique();
            $table->double('amount');
            $table->boolean('status')->default(false);
            $table->boolean('confirmed')->default(false);
            $table->timestamps();
            $table->engine = 'InnoDB';

            $table->foreign('order_id')->references('id')->on('orders')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')
                ->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders_penalty');
    }
}
