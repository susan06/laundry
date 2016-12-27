<?php

use Illuminate\Database\Seeder;

class SuggestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suggestions')->insert([
        	'user_id' => 2,
            'content' => 'Nam officiis quaerat recusandae omnis praesentium dolore. Hic ut rerum voluptas eaque voluptates. Sint in quo quidem distinctio. Quibusdam aspernatur ab non amet rerum qui harum quasi. Non cupiditate hic repellat sunt tempore commodi aliquid. Nulla itaque id corporis ut est deserunt ea. Explicabo quo temporibus magni. Sunt minima suscipit expedita qui harum dolor'
        ]);

         DB::table('suggestions')->insert([
        	'user_id' => 2,
            'content' => 'Explicabo quo temporibus magni. Sunt minima suscipit expedita qui harum dolor.Nam officiis quaerat recusandae omnis praesentium dolore. Hic ut rerum voluptas eaque voluptates. Sint in quo quidem distinctio.'
        ]);
    }
}
