<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BranchOfficeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_offices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->integer('representative_id')->unsigned();
            $table->string('status', 20);
            $table->integer('created_by');
            $table->timestamps();
            $table->engine = 'InnoDB';
            
            $table->foreign('representative_id')->references('id')->on('users')
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
        Schema::drop('branch_offices');
    }
}
