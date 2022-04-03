<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

include('settingSeeder.php');
include('usersTableSeeder.php');
include('instagramFilterSeeder.php');
include('twitterFilterSeeder.php');
include('competitor1FilterSeeder.php');
include('competitor2FilterSeeder.php');
include('login_codesSeeder.php');
include('CodeSeeder.php');


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('usersTableSeeder');
        $this->call('settingSeeder');
        $this->call('twitterFilterSeeder');
        $this->call('instagramFilterSeeder');
        $this->call('competitor1FilterSeeder');
        $this->call('competitor2FilterSeeder');
        $this->call('login_codesSeeder');
        $this->call('CodeSeeder');
        
        Model::reguard();
    }
}
