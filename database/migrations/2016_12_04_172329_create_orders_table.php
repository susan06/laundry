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
            $table->string('bag_code')->nullable();
            $table->integer('client_id')->unsigned();
            $table->integer('driver_id')->unsigned()->nullable();
            $table->integer('client_location_id')->unsigned();
            $table->date('date_search');
            $table->integer('time_search');
            $table->date('date_delivery');
            $table->integer('time_delivery');
            $table->integer('branch_offices_id')->nullable();
            $table->integer('branch_offices_location_id')->nullable();
            $table->integer('client_coupon_id')->nullable();
            $table->text('special_instructions')->nullable();
            $table->text('note')->nullable();
            $table->double('sub_total');
            $table->double('discount')->nullable();
            $table->double('total');
            $table->string('status')->default('search');
            $table->timestamp('date_delivered')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
            
            $table->foreign('client_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('client_location_id')->references('id')->on('clients_locations')
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
        Schema::drop('orders');
    }
}
