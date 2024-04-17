<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateA4DruckersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a4_druckers', function (Blueprint $table) {
            $table->id();
            $table->string('Ausgabedienst');
            $table->string('Druckername');
            $table->integer('Druckernummer01');
            $table->integer('Druckernummer02');
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
        Schema::dropIfExists('a4_druckers');
    }
}
