<?php

use Illuminate\Database\Seeder;

class competitor1FilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('competitor1filters')->truncate();
        
        DB::table('competitor1filters')->insert([
            'filter' => '@Jollibee',
        ]);

        DB::table('competitor1filters')->insert([
            'filter' => 'beeHappy',
        ]);

        DB::table('competitor1filters')->insert([
            'filter' => 'bidaAngSaya',
        ]);

        DB::table('competitor1filters')->insert([
            'filter' => 'langhapSarap',
        ]);
    }
}
