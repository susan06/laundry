<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('bag_code')->unique();
            $table->integer('client_id')->unsigned();
            $table->integer('client_location_id')->unsigned();
            $table->date('date_search');
            $table->integer('time_search');
            $table->date('date_delivery');
            $table->integer('time_delivery');
            $table->integer('client_coupon_id')->nullable();
            $table->text('special_instructions')->nullable();
            $table->double('sub_total');
            $table->double('discount')->nullable();
            $table->double('total');
            $table->timestamps();
            $table->engine = 'InnoDB';
            
            $table->foreign('client_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('client_location_id')->references('id')->on('clients_locations')
                ->onUpdate('cascade')->onDelete('cascade');
           // $table->foreign('client_coupon_id')->references('id')->on('clients_coupons')
                //->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
