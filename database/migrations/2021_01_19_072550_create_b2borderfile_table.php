<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateB2borderfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b2borderfile', function (Blueprint $table) {
            $table->id();
            $table->string('orderReference')->nullable();
			$table->longText('orderdataArray')->nullable();
			$table->longText('splitorderdata' )->nullable();
			$table->bigInteger('shopID')->nullable();
   			$table->string('kundennummer')->nullable();
			$table->string('externebestellnummer')->nullable();
            $table->string('lager')->nullable();
			$table->string('status')->nullable();
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
        Schema::dropIfExists('b2borderfile');
    }
}
