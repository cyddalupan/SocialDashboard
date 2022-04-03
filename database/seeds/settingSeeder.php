<?php

use Illuminate\Database\Seeder;

class settingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
    	DB::table('settings')->truncate();

        DB::table('settings')->insert([
            'name' => 'ClientName',
            'value' => 'McDonald\'s',
        ]);

        DB::table('settings')->insert([
            'name' => 'ClientTwitterTitle',
            'value' => 'McDo Philippines',
        ]);

        DB::table('settings')->insert([
            'name' => 'ClientFacebookTitle',
            'value' => 'McDonald\'s Philippines',
        ]);

        DB::table('settings')->insert([
            'name' => 'ClientInstagramTitle',
            'value' => 'mcdo_ph',
        ]);

        DB::table('settings')->insert([
            'name' => 'Competitor1TwitterTitle',
            'value' => 'Jollibee',
        ]);

        DB::table('settings')->insert([
            'name' => 'Competitor1FacebookTitle',
            'value' => 'Jollibee Philippines',
        ]);

        DB::table('settings')->insert([
            'name' => 'Competitor2TwitterTitle',
            'value' => 'KFC',
        ]);

        DB::table('settings')->insert([
            'name' => 'Competitor2FacebookTitle',
            'value' => 'KFC Philippines',
        ]);

        DB::table('settings')->insert([
            'name' => 'link2Pie',
            'value' => 'public/img/sample-pie.jpg',
        ]);

        DB::table('settings')->insert([
            'name' => 'link2Chart',
            'value' => 'public/img/sample-trend.jpg',
        ]);

        DB::table('settings')->insert([
            'name' => 'recoText',
            'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitationLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.',
        ]);

        DB::table('settings')->insert([
            'name' => 'recoImg',
            'value' => 'public/img/nature-q-c-640-480-8.jpg',
        ]);

        DB::table('settings')->insert([
            'name' => 'AdminEmail',
            'value' => 'joe.quiamzon@ph.arcww.com',
        ]);

        DB::table('settings')->insert([
            'name' => 'profileImg',
            'value' => 'public/img/GetPersonaPhoto.jpeg',
        ]);

    }
}
