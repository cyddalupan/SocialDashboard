<?php

use Illuminate\Database\Seeder;

class competitor2FilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('competitor2filters')->truncate();
        
        DB::table('competitor2filters')->insert([
            'filter' => '@KFCPhilippines',
        ]);

        DB::table('competitor2filters')->insert([
            'filter' => 'fingerLickinGood',
        ]);

        DB::table('competitor2filters')->insert([
            'filter' => 'tastesSoGood',
        ]);

        DB::table('competitor2filters')->insert([
            'filter' => 'kentucky',
        ]);
    }
}
