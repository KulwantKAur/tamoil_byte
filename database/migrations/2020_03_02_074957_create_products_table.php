<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('billbee_id')->nullable();
            $table->string('ean', 20)->nullable();
            $table->string('sku', 50)->nullable();
            $table->string('title', 250)->nullable();
            $table->string('stock_code', 100)->nullable();
            $table->string('stock_current')->nullable();
            $table->string('delta_quantity')->nullable();
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
        Schema::dropIfExists('products');
    }
}
