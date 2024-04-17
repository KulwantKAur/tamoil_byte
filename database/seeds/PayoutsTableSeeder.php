<?php
namespace Database\Seeders;
use App\Models\Payout;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PayoutsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payouts')->insert([
            [
                'PayoutId' => '67452043328',
                'Status' => 'in_transit',
                'Type' => 'charge',
                'PayoutDate' => '2021-03-03',
                'Payout_Total_amount' => '9968.11',
                'TransactionID' => '3638893838400',
                'OrderAmount' => '139.00',
                'ShopifyFee' => '2.34',
                'NetAmount' => '136.66',
                'Shopify_Order_Number' => '10173658',
                'OrderDate' => '2021-02-26T07:11:29+01:00',
            ],
            [
                'PayoutId' => '67452043328',
                'Status' => 'in_transit',
                'Type' => 'charge',
                'PayoutDate' => '2021-03-03',
                'Payout_Total_amount' => '9968.11',
                'TransactionID' => '3638899966016',
                'OrderAmount' => '63.90',
                'ShopifyFee' => '2.26',
                'NetAmount' => '61.64',
                'Shopify_Order_Number' => '10173659',
                'OrderDate' => '2021-02-26T07:35:39+01:00',
            ],
            [
                'PayoutId' => '67452043328',
                'Status' => 'in_transit',
                'Type' => 'charge',
                'PayoutDate' => '2021-03-03',
                'Payout_Total_amount' => '9968.11',
                'TransactionID' => '3638921101376',
                'OrderAmount' => '169.00',
                'ShopifyFee' => '2.79',
                'NetAmount' => '166.21',
                'Shopify_Order_Number' => '10173662',
                'OrderDate' => '2021-02-26T08:38:09+01:00',
            ],
        ]);
    }
}
