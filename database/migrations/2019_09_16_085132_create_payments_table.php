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
            $table->integer('payment_type_id');

            $table->integer('leasing_agreement_id')->nullable()->default(null);
            $table->integer('billing_id')->nullable()->default(null);
            $table->integer('tenant_id')->nullable()->default(null);

            $table->double('amount_due', 8, 2);
            $table->double('amount_paid', 8, 2);
            $table->string('reference_no')->nullable()->default(null);
            $table->string('note')->nullable()->default(null);
            
            $table->integer('processed_by_user')->nullable()->default(null);
            $table->integer('file_id')->nullable()->default(null);

            $table->string('slug')->nullable()->default(null)->unique();
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
