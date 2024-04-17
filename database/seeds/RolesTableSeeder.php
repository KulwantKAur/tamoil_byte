<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	 //Definition der Rollen
    public function run()
    {
        Role::truncate();

        Role::create(['name'=>'Order']);
        Role::create(['name'=>'Orders']);
        Role::create(['name'=>'Quality']);
        Role::create(['name'=>'Receipt']);
        Role::create(['name'=>'ReceiptB2X']);
        Role::create(['name'=>'ReceiptInbound']);
        Role::create(['name'=>'Inventory']);
        Role::create(['name'=>'InventoryChange']);
        Role::create(['name'=>'InventoryAdmin']);
        Role::create(['name'=>'Finance']);
        Role::create(['name'=>'B2B']);
        Role::create(['name'=>'B2BUpload']);
        Role::create(['name'=>'B2BSync']);
        Role::create(['name'=>'Store']);
        Role::create(['name'=>'User']);
        Role::create(['name'=>'UserAdmin']);

    }
}
