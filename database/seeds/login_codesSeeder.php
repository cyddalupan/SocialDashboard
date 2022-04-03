<?php

use Illuminate\Database\Seeder;

class login_codesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('login_codes')->truncate();
        
        for($x = 0; $x <= 50; $x++){
            DB::table('login_codes')->insert([
                'code' => str_random(40),
                'used' => '0',
            ]);
        }
    }
}
