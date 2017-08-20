<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UsersTableSeed::class);
        $this->call(RolesTableSeed::class);
        $this->call(RolesUsersTableSeed::class);
        $this->call(PaymentTableSeeder::class);
        $this->call(SocialNetworksSeeder::class);
        $this->call(QuestionsTableSeeder::class);
    }
}
