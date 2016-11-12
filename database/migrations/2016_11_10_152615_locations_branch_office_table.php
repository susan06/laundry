<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LocationsBranchOfficeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_office_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_office_id')->unsigned();
            $table->string('label');
            $table->string('lat');
            $table->string('lng');
            $table->string('address');
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
        Schema::drop('branch_office_locations');
    }
}
