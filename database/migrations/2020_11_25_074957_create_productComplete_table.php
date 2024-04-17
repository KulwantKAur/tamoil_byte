<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCompleteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_completes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('billbee_id')->nullable();
            $table->string('ean', 20)->nullable();
            $table->string('sku', 50)->nullable();
            $table->string('title', 250)->nullable();
            $table->string('stock_code_A-Ware_Hamburg')->nullable();
            $table->string('stock_current_A-Ware_Hamburg')->nullable();
            $table->string('stock_code_B-Ware_Hamburg')->nullable();
			$table->string('stock_current_B-Ware_Hamburg')->nullable();
			$table->string('stock_code_A-Ware_Koeln')->nullable();
            $table->string('stock_current_A-Ware_Koeln')->nullable();
            $table->string('stock_code_B-Ware_Koeln')->nullable();
			$table->string('stock_current_B-Ware_Koeln')->nullable();
            $table->string('stock_code_B2B_Plattform')->nullable();
            $table->string( 'stock_current_B2B_Plattform')->nullable();
            $table->string('stock_code_Safetystock')->nullable();
            $table->string('stock_current_Safetystock')->nullable();
			$table->string('stock_code_OWL')->nullable();
            $table->string('stock_current_OWL')->nullable();
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
        Schema::dropIfExists('product_completes');
    }
}
