<?php

use Illuminate\Database\Seeder;

class PaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            'id' => '1',
            'dateIn' => '2017-09-27',
            'dateOut' => '2017-09-28',
            'amount' => '400',
            'type' => '1',
        ]);

        DB::table('payments')->insert([
            'id' => '2',
            'dateIn' => '2017-09-27',
            'dateOut' => '2017-09-28',
            'amount' => '400',
            'type' => '1',
        ]);
    }
}
