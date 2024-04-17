<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConfigurationShopid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuration_shopid', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('shopid')->nullable();
            $table->string('name')->nullable();
            $table->string('pickliste')->nullable();
            $table->Integer('status')->nullable();
            $table->string('retourenform')->nullable();
            $table->boolean('sync')->nullable();
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
