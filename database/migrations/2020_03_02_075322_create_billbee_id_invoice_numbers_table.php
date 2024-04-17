<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillbeeIdInvoiceNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billbee_id_invoice_numbers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("invoice_number")->nullable();
            $table->string("billbee_id")->nullable();
            $table->string("order_number")->nullable();
            $table->string("shop_id")->nullable();
            $table->string("status")->nullable();
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
        Schema::dropIfExists('billbee_id_invoice_numbers');
    }
}
