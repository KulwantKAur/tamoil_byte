<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_labels', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->String('OrderNumber')->nullable();
			$table->longText('ShippingLabel')->nullable();
			$table->longText('ExportDocuments')->nullable();
			$table->longText('DeliveryNote')->nullable();
			$table->longText('InvoiceDocument')->nullable();
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
        Schema::dropIfExists('order_labels');
    }
}
