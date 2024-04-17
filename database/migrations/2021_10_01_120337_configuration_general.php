<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConfigurationGeneral extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuration_general', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('billbeeapikey')->nullable();
            $table->string('billbeebaseurl')->nullable();
            $table->string('billbeeusername')->nullable();
            $table->string('billbeepassword')->nullable();
            $table->string('druckerwolkeapikey')->nullable();
            $table->string('druckerwolkebaseurl')->nullable();
            $table->string('druckerwolkeusername')->nullable();
            $table->string('druckerwolkepassword')->nullable();
            $table->Integer('eCom_pickup_Shopid')->nullable();
            $table->Integer('local_pickup_id')->nullable();
            $table->Integer('ProductId_international')->nullable();
            $table->Integer('order_state_id')->nullable();
            $table->Integer('b2b_customer')->nullable();
            $table->Integer('b2b_customers_noExport')->nullable();
            $table->Integer('sent_order_state_id')->nullable();
            $table->Integer('credit_note_state_id')->nullable();
            $table->Integer('vorkasseId')->nullable();
            $table->Integer('fakeshopid')->nullable();
            $table->string('SellerPlatform')->nullable();
            $table->string('SellerShopName')->nullable();
            $table->Integer('SellerShopId')->nullable();
            $table->string('SellerID')->nullable();
            $table->string('inventory')->nullable();
            $table->string('retourenSupport')->nullable();
            $table->Integer('B2B_SellerID')->nullable();
            $table->boolean('B2B_acceptLossOfReturnRight')->nullable();
            $table->Integer('B2B_state')->nullable();
            $table->string('B2B_platform')->nullable();
            $table->string('B2B_shopName')->nullable();
            $table->string('B2B_id')->nullable();
            $table->Integer('B2B_default_stock_id')->nullable();
            $table->boolean('B2B_dontAdjustStock')->nullable();
            $table->boolean('RetourenLabel')->nullable();
            $table->Integer('B2B_orderUploadDefaultShopId')->nullable();
            $table->Integer('taxRateB2B')->nullable();
            $table->boolean('B2BnettoUpload')->nullable();
            $table->boolean('stuecklisteReverseLogic')->nullable();
            $table->string('techSupport')->nullable();
            $table->string('sortOrdersBy')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
