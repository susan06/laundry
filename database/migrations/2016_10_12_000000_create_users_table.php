<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->date('birthday')->nullable(); 
            $table->string('phones')->nullable();
            $table->string('status', 20);
            $table->string('avatar')->nullable();
            $table->string('lang')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->string('password');
            $table->string('confirmation_token', 60)->nullable();
            $table->boolean('online')->default(false);
            $table->rememberToken();
            $table->timestamps();
            $table->engine = 'InnoDB';

            $table->foreign('role_id')->references('id')->on('roles')
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
        Schema::drop('users');
    }
}
