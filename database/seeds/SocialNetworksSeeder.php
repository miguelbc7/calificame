<?php

use Illuminate\Database\Seeder;

class SocialNetworksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('social_networks')->insert([
            'id' => 1,
            'facebook' => 'www.facebook.com',
            'twitter' => 'www.twitter.com',
            'linkedin' => 'www.linkedin.com',
        ]);
    }
}
