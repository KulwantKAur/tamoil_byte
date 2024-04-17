<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerInvoiceNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_invoice_numbers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_number')->unsigned();
            $table->string('invoice_number')->nullable();
            $table->string('RE')->default("No");
            $table->string('GE')->default("No");
            $table->string('DE')->default("No");
            $table->string('LE')->default("No");
            $table->string('ME')->default("No");
			$table->string('export_type')->nullable();
			$table->string('total_gross')->nullable();
            $table->string('order_number')->nullable();
            $table->string('vat_mode')->nullable();
            $table->timestamp('invoice_date')->nullable();
			$table->string('document_type')->nullable();
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
        Schema::dropIfExists('customer_invoice_numbers');
    }
}
