<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payouts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('PayoutId');
            $table->string('Status');
            $table->string('Type');
            $table->date('PayoutDate');
            $table->float('Payout_Total_amount');
            $table->bigInteger('TransactionID')->nullable();
            $table->float('OrderAmount');
            $table->float('ShopifyFee');
            $table->float('NetAmount');
            $table->string('Shopify_Order_Number')->nullable();
            $table->string('OrderDate');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payouts');
    }
}
