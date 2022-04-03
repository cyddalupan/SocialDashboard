<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Crypt;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        
        DB::table('users')->insert([
            'username' => 'cyd',
            'password' => Crypt::encrypt('cyd'),
        ]);

        DB::table('users')->insert([
            'username' => 'arcww123',
            'password' => Crypt::encrypt('alpha245'),
        ]);

        DB::table('users')->insert([
            'username' => 'joe',
            'email' => 'joe.quiamzon@ph.arcww.com',
            'profile_img' => 'img/GetPersonaPhoto.jpeg',
            'password' => Crypt::encrypt('joe'),
        ]);
    }
}
