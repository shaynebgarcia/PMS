<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('property_id');
            $table->integer('leasing_agreement_details_id');
            $table->string('invoice_no');
            
            $table->string('monthyear');
            $table->date('billing_from');
            $table->date('billing_to');
            $table->date('billing_date');
            $table->date('due_date');
            $table->string('prepared_by')->nullable();
            $table->integer('published_by')->default(1);
            $table->double('subtotal_amount', 8, 2);
            $table->double('ou_amount', 8, 2)->default(0);
            $table->double('total_amount_due', 8, 2);
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
        Schema::dropIfExists('billings');
    }
}
