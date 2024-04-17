<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVatModeToBillbeeIdInvoiceNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('billbee_id_invoice_numbers', function (Blueprint $table) {
            $table->integer("vat_mode")->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('billbee_id_invoice_numbers', function (Blueprint $table) {
            //
        });
    }
}
