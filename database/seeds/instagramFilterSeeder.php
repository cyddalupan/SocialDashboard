<?php

use Illuminate\Database\Seeder;

class instagramFilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instagramFilter')->truncate();

        DB::table('instagramFilter')->insert([
            'filter' => 'mcdo',
        ]);

        DB::table('instagramFilter')->insert([
            'filter' => 'minions',
        ]);

        DB::table('instagramFilter')->insert([
            'filter' => 'lovekoto',
        ]);

    }
}
