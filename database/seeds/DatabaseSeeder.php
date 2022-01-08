<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
        // factory(App\Offre::class,100)->create();
       // factory(App\Candidat::class,100)->create();
        //factory(App\Account::class,100)->create(); 
       factory(App\Like::class,200)->create(); 
       
    }
}
