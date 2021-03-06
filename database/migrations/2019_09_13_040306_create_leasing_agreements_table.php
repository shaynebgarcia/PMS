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
            $table->string('link_id')->unique()->nullable();
            $table->integer('property_id');
            $table->integer('unit_id');
            // $table->integer('tenant_id');
            // $table->integer('tenant_list_id');
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
        Schema::dropIfExists('leasing_agreements');
    }
}
