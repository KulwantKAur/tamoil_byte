<?php

use Illuminate\Database\Seeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\BoxesTableSeeder;
use Database\Seeders\A4DruckerSeeder;
use Database\Seeders\LabelDruckerSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
	 //Ruft die beiden TableSeeder auf und lässt sie laufen
    public function run()
    {
		 $this->call(RolesTableSeeder::class);
         $this->call(UsersTableSeeder::class);
        //  $this->call(PayoutsTableSeeder::class); //doesn't need to be active since this Seeder needs to only run one Time!! Or after a complete migration refresh
         $this->call(BoxesTableSeeder::class);
         $this->call(A4DruckerSeeder::class);
         $this->call(LabelDruckerSeeder::class);

    }
}
