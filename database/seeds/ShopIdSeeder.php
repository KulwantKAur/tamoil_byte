<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Shopid;
class ShopIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shopids')->insert([

        [
            'shopname'=> 'B2C1',
            'shopid'=> '61275',
        ],
        [
            'shopname'=> 'B2C2',
            'shopid'=> '67221',
        ],
        [
            'shopname'=> 'B2C3',
            'shopid'=> '76201',
        ],

        [
            'shopname'=> 'B2B',
            'shopid'=> '79993',// 61950,79993,81405
        ],
        [
            'shopname'=> 'Amazon',
            'shopid'=> '61984',
        ],
        [
            'shopname'=> 'reklamation1',
            'shopid'=> '62654 ',
        ],
        [
            'shopname'=> 'reklamation2',
            'shopid'=> '76305',
        ],
        ]);
    }
}
