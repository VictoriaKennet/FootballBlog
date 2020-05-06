<?php

use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('socials')->insert([
            'title' => "facebook",
            'url' => 'https://www.facebook.com/',
            'logo' => '/img/socials/facebook.png',
        ]);
        DB::table('socials')->insert([
            'title' => "twitter",
            'url' => 'https://twitter.com/',
            'logo' => '/img/socials/twitter.png',
        ]);
        DB::table('socials')->insert([
            'title' => "instagram",
            'url' => 'https://www.instagram.com/',
            'logo' => '/img/socials/instagram.png',
        ]);
    }
}
