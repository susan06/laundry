<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('driver_id')->unsigned()->nullable();
            $table->integer('branch_office_id')->unsigned()->nullable();
            $table->text('description')->nullable();
            $table->boolean('read_on')->default(false);
            $table->timestamps();
            $table->engine = 'InnoDB';
            
            $table->foreign('driver_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('branch_office_id')->references('id')->on('branch_offices')
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
        Schema::drop('notifications');
    }
}
