<?php

use Illuminate\Database\Seeder;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('information')->insert([
            'key' => "about",
            'value' => 'Painful so he an comfort is manners. Is inquiry no he several excited am. Is inquiry no he several excited am. Mirth learn it he given. Made neat an on be gave show snug tore. Is inquiry no he several excited am. Sportsman do offending supported extremity breakfast by listening. If as increasing contrasted ent',
        ]);
        DB::table('information')->insert([
            'key' => "email",
            'value' => 'misha@i.ua',
        ]);
        DB::table('information')->insert([
            'key' => "phone",
            'value' => '0000000000',
        ]);
        DB::table('information')->insert([
            'key' => "address",
            'value' => 'Суми'
        ]);
    }
}
