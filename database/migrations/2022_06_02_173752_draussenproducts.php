<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Draussenproducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draussenproducts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('products_id')->nullable();
            $table->string('products_sku', 20)->nullable();
            $table->string('products_ean', 50)->nullable();
            $table->string('products_name', 250)->nullable();
            $table->string('products_unitamount', 100)->nullable();
            $table->string('products_stocklocation')->nullable();
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
