<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->increments('id');
            $table->text('question');
            $table->text('answer');
            $table->string('status')->default('Published');
            $table->integer('created_by');
            $table->timestamps();
            $table->engine = 'MyISAM';
        });

        DB::statement('ALTER TABLE faqs ADD FULLTEXT search(question, answer)');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('faqs', function($table) {
            $table->dropIndex('search');
        });
        Schema::drop('faqs');
    }
}
