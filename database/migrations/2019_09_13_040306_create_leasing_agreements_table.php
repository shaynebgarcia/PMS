<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeasingAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leasing_agreements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('unit_id');
            $table->integer('tenant_id');
            $table->double('agreed_lease_price', 8, 2)->nullable()->default(null);
            $table->date('date_of_contract')->nullable()->default(null);
            $table->date('term_start')->nullable()->default(null);
            $table->date('term_end')->nullable()->default(null);
            $table->string('monthly_collection')->nullable()->default('1');
            $table->date('move_in')->nullable()->default(null);
            $table->string('status')->default('Processing');
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
        Schema::dropIfExists('leasing_agreements');
    }
}
