<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_no')->nullable()->default(null)->unique();
            $table->integer('property_id');
            // $table->integer('leasing_agreement_id');
            $table->integer('leasing_agreement_details_id');

            $table->string('to_bill')->nullable();
            $table->double('total_amount', 8, 2)->default(0);

            $table->integer('status_id');
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
        Schema::dropIfExists('job_orders');
    }
}
