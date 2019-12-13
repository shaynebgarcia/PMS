<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeasingAgreementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leasing_agreement_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('property_id');
            $table->integer('leasing_agreement_id');
            $table->string('agreement_no')->nullable()->default(null)->unique();
            
            $table->string('description')->default('Original');
            $table->double('agreed_lease_price', 8, 2)->nullable()->default(null);
            $table->double('agreed_lease_price_daily', 8, 2)->nullable()->default(null);

            $table->integer('term_duration')->nullable()->default(12);
            $table->date('term_start')->nullable()->default(null);
            $table->date('term_end')->nullable()->default(null);
            $table->date('first_day')->nullable()->default(null);
            $table->date('last_day')->nullable()->default(null);
            $table->integer('monthly_due')->nullable()->default('1');

            $table->integer('status_id');

            $table->string('last_billing_my')->nullable()->default(null);
            $table->date('expired')->nullable()->default(null);
            $table->date('renewed')->nullable()->default(null);

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
        Schema::dropIfExists('leasing_agreement_details');
    }
}
