<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('payment_no')->nullable()->default(null)->unique();
            $table->integer('property_id');
            $table->integer('payment_type_id');

            // $table->integer('leasing_agreement_id')->nullable()->default(null);
            $table->integer('leasing_agreement_details_id')->nullable()->default(null);
            $table->integer('billing_id')->nullable()->default(null);
            $table->integer('tenant_id')->nullable()->default(null);

            $table->double('amount_due', 8, 2);
            $table->double('amount_paid', 8, 2);
            $table->string('payment_method')->nullable()->default(null);
            $table->string('reference_no')->nullable()->default(null);
            $table->string('note')->nullable()->default(null);
            
            $table->integer('processed_by_user')->nullable()->default(null);

            $table->date('date_paid')->nullable()->default(null);
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
        Schema::dropIfExists('payments');
    }
}
