<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderMatricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_matrices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('billbee_id')->nullable();
            $table->string('OrderRef')->nullable();
            //$table->string('title')->nullable();
            //$table->string('SKU')->nullable();
            //$table->bigInteger('EAN')->nullable();
            $table->string('Box')->nullable();
            $table->string('weight')->nullable();
            $table->integer('quantity')->nullable();
            //$table->string('single_price')->nullable();
            $table->string('total_Price')->nullable();
            $table->longText('shipping_label')->nullable();
            $table->longText('export_pdf')->nullable();
            $table->longText('invoice_pdf')->nullable();
			$table->string('user')->nullable(); 
			$table->longText('delivery_pdf')->nullable();
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
        Schema::dropIfExists('order_matrices');
    }
}
