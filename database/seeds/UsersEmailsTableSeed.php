<?php

use Illuminate\Database\Seeder;

class UsersEmailsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_email')->insert([
            'user_id' => 1,
            'email_id' => 1,
        ]);

        DB::table('user_email')->insert([
            'user_id' => 2,
            'email_id' => 2,
        ]);
    }
}
