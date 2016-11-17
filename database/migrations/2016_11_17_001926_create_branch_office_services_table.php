<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchOfficeServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_office_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_office_id')->unsigned();
            $table->string('name');
            $table->double('price');
            $table->string('status')->default('Available');
            $table->timestamps();
            $table->engine = 'InnoDB';
            
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
        Schema::drop('branch_office_services');
    }
}
