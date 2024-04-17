<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id')->nullable();
            $table->string('full_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('country_code')->nullable();
            $table->string('zip')->nullable();
            $table->string('tel1')->nullable();
            $table->string('tel2')->nullable();
            $table->string('email')->nullable();
            $table->integer('customer_number')->nullable();
            $table->string('company')->nullable();
            $table->string('is_exported')->nullable();
            $table->integer('payment_term')->unsigned()->nullable();
            $table->integer('limit')->nullable();
	        $table->string('export_type')->nullable();
            $table->integer('vat_mode')->nullable();
			$table->timestamp('limit_updated_at')->nullable();
            $table->timestamp('payment_term_updated_at')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
