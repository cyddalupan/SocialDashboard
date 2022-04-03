<?php

use Illuminate\Database\Seeder;

class twitterFilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('twitterFilter')->truncate();
        
        DB::table('twitterFilter')->insert([
            'filter' => '@McDo_PH',
        ]);

        DB::table('twitterFilter')->insert([
            'filter' => 'lovekoto',
        ]);

        DB::table('twitterFilter')->insert([
            'filter' => 'minions',
        ]);

        DB::table('twitterFilter')->insert([
            'filter' => 'mcdo',
        ]);
    }
}
