<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateB2bsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b2b', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->Integer('BillbeeShopId');
			$table->String('ExterneBestellnummer');
			$table->Integer('Kundennummer');
			$table->String('Kundenname');
			$table->String('EAN');
			$table->String('SKU');
			$table->Integer('Anzahl');
			$table->Float('PreisStück')->nullable();
			$table->Float('Versandkosten')->nullable();
            $table->Float('Bestand');
            $table->String('ProduktName');
			$table->String('LieferadresseName');
			$table->String('LieferadresseStraße');
			$table->String('LieferadresseHausnummer');
			$table->String('LieferadressePLZ');
			$table->String('LieferadresseStadt');
			$table->String('LieferadresseLand');
			$table->String('vatMode');
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
        Schema::dropIfExists('b2b');
    }
}
