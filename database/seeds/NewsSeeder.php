<?php

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert([
            'title' => "Lorem ipsum",
            'photo' => '/img/default.png',
            'text' => 'Painful so he an comfort is manners. Is inquiry no he several excited am. Is inquiry no he several excited am. Mirth learn it he given. Made neat an on be gave show snug tore. Is inquiry no he several excited am. Sportsman do offending supported extremity breakfast by listening. If as increasing contrasted ent',
        ]);
    }
}
