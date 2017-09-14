<?php

use Illuminate\Database\Seeder;

class UsersPaymentsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_payment')->insert([
            'user_id' => 1,
            'payment_id' => 1,
        ]);

        DB::table('user_payment')->insert([
            'user_id' => 2,
            'payment_id' => 2,
        ]);
    }
}
