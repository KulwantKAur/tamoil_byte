<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt_booking', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("receipt_type")->nullable();
            $table->string("reference")->nullable();
            $table->string("ean")->nullable();
			$table->string("sku")->nullable();
            $table->string("delta_quantity")->nullable();
            $table->string("reason_code")->nullable();
            $table->string("stock_id")->nullable();
            $table->string("a_ware")->nullable();
            $table->string("b_ware")->nullable();
            $table->string("defekt")->nullable();
			$table->string("b2b")->nullable();
			$table->string("safetystock")->nullable();
			$table->string("owl")->nullable();
			$table->string("comment")->nullable();
			$table->string("umbuchen")->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipt_booking');
    }
}
