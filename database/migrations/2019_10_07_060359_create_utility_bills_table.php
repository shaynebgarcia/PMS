<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUtilityBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utility_bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('property_id');
            $table->integer('leasing_agreement_details_id');
            $table->integer('utility_id');
            $table->string('to_bill');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->double('prev_reading', 8, 2)->nullable();
            $table->double('pres_reading', 8, 2)->nullable();
            // $table->double('gen_charge', 8, 2)->nullable();
            $table->double('kw_used', 8, 2)->nullable();
            $table->double('cubic_meter', 8, 2)->nullable();
            
            $table->double('amount', 8, 2);
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
        Schema::dropIfExists('utility_bills');
    }
}
