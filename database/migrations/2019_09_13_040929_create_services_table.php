<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('property_id');
            $table->integer('leasing_agreement_details_id');
            $table->string('service_no')->nullable()->default(null);
            $table->integer('service_type_id');
            $table->string('to_bill')->nullable();
            $table->boolean('first_bill')->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->double('amount', 8, 2)->nullable();
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
        Schema::dropIfExists('services');
    }
}
