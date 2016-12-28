<?php

use Illuminate\Database\Seeder;

class ClientFriendsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('client_friends')->insert([
            'user_id' => 2,
            'email' => 'friend_1@email.com',
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('client_friends')->insert([
            'user_id' => 2,
            'email' => 'friend_2@email.com',
            'created_at' => \Carbon\Carbon::now()
        ]);
    }
}
