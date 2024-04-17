<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate(); //deletes all the Data to create new
		DB::table('role_user')->truncate();
		// variables for the Roles
		//gets the role into the variable and takes the first instance it finds the role
		$adminRole = Role::where('name','UserAdmin')->first();
        $lagerRole = Role::where('name','Orders')->first();
        $serviceRole =Role::where('name','Quality')->first();

		//created dummy Users

		$admin = User::create([
		'name'=>'Admin User',
        'email'=>'christian@kerbholz.com',
        'username'=>'admin',
		'password'=>Hash::make('Kerbholz!2021#')
        ]);


		/*
        $service = User::create([
            'name'=>'Service User',
            'email'=>'service@service.com',
            'username'=>'service',
            'password'=>Hash::make('passwort')
            ]);

		$support = User::create([
		'name'=>'Costumer-Support ',
        'email'=>'sup@sup.com',
        'username'=>'cs',
		'password'=>Hash::make('passwort')
		]);

		$lager = User::create([
		'name'=>'Lager User',
        'email'=>'lager@lager.com',
        'username'=>'lager',
		'password'=>Hash::make('passwort')
        ]);
        $user = User::create([
            'name'=>'user',
            'email'=>'user@user.com',
            'username'=>'user',
            'password'=>Hash::make('passwort')
            ]);*/
		//Rollenzuteilung
        
        $admin->roles()->attach($adminRole);
        $admin->roles()->attach($lagerRole);
        $admin->roles()->attach($serviceRole);
		
        //$service->roles()->attach($serviceRole);
		//$support->roles()->attach($supportRole);
		//$lager->roles()->attach($lagerRole);


    }
}
