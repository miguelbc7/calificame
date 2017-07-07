<?php

use Illuminate\Database\Seeder;

class UsersTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '1',
            'company' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345'),
        ]);
    }
}