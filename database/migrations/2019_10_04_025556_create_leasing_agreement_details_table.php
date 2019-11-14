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
            $table->integer('leasing_agreement_id');
            $table->string('agreement_no')->unique();
            $table->string('description')->default('Original');
            $table->double('agreed_lease_price', 8, 2)->nullable()->default(null);
            $table->date('term_start')->nullable()->default(null);
            $table->date('term_end')->nullable()->default(null);
            $table->date('first_day')->nullable()->default(null);
            $table->string('monthly_due')->nullable()->default('1');
            $table->string('status')->default('Active');
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
