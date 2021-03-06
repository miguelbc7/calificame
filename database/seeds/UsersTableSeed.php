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
            'avatar' => 'img/users/0/avatar/avatar.jpg',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345'),
            'type' => '1',
            'status' => '1',
            'branch' => '1',
        ]);

        DB::table('users')->insert([
            'id' => '2',
            'company' => 'Sagecrow',
            'avatar' => 'img/users/0/avatar/avatar.jpg',
            'email' => 'miguel.lm21@gmail.com',
            'password' => bcrypt('19956004'),
            'type' => '2',
            'status' => '1',
            'branch' => '2',
        ]);
    }
}
