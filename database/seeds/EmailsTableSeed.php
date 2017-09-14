<?php

use Illuminate\Database\Seeder;

class EmailsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('emails')->insert([
        	'email' => 'admin@admin.com',
        ]);

        DB::table('emails')->insert([
            'email' => 'miguel.lm21@gmail.com',
        ]);
    }
}
