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

        DB::table('users')->insert([
            'id' => '2',
            'company' => 'Sagecrow',
            'email' => 'miguel.lm21@gmail.com',
            'password' => bcrypt('19956004'),
        ]);
    }
}
