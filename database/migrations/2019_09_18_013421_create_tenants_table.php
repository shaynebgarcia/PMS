<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');

            $table->string('contact')->nullable()->default(null);

            $table->string('address')->nullable()->default(null);
            $table->string('address_tel')->nullable()->default(null);
            $table->string('address2')->nullable()->default(null);
            $table->string('address2_tel')->nullable()->default(null);
            $table->string('address3')->nullable()->default(null);
            $table->string('address3_tel')->nullable()->default(null);

            $table->date('birthdate')->nullable()->default(null);
            $table->string('birthplace')->nullable()->default(null);
            $table->string('age')->nullable()->default(null);
            $table->string('occupation')->nullable()->default(null);

            $table->string('emp_name')->nullable()->default(null);
            $table->string('office_address')->nullable()->default(null);
            $table->string('office_tel')->nullable()->default(null);
            $table->string('yrs_w_employer')->nullable()->default(null);

            $table->string('prev_emp_name')->nullable()->default(null);
            $table->string('prev_emp_address')->nullable()->default(null);

            $table->string('spouse_name')->nullable()->default(null);
            $table->string('spouse_occupation')->nullable()->default(null);
            $table->string('spouse_emp_name')->nullable()->default(null);
            $table->string('spouse_emp_address')->nullable()->default(null);
            $table->string('spouse_emp_tel')->nullable()->default(null);

            $table->string('rel1_name')->nullable()->default(null);
            $table->string('rel1_occupation')->nullable()->default(null);
            $table->string('rel1_emp_name')->nullable()->default(null);
            $table->string('rel1_emp_address')->nullable()->default(null);
            $table->string('rel1_emp_tel')->nullable()->default(null);

            $table->string('rel2_name')->nullable()->default(null);
            $table->string('rel2_occupation')->nullable()->default(null);
            $table->string('rel2_emp_name')->nullable()->default(null);
            $table->string('rel2_emp_address')->nullable()->default(null);
            $table->string('rel2_emp_tel')->nullable()->default(null);

            $table->string('em_name')->nullable()->default(null);
            $table->string('em_rel')->nullable()->default(null);
            $table->string('em_contact_home')->nullable()->default(null);
            $table->string('em_contact_work')->nullable()->default(null);
            $table->string('em_contact_phone')->nullable()->default(null);
            $table->string('em_address')->nullable()->default(null);

            $table->string('college_uni')->nullable()->default(null);
            $table->string('college_yr')->nullable()->default(null);
            $table->string('college_course')->nullable()->default(null);
            $table->string('hs_name')->nullable()->default(null);
            $table->string('hs_yr')->nullable()->default(null);
            $table->string('gs_name')->nullable()->default(null);
            $table->string('gs_yr')->nullable()->default(null);
            $table->string('masters')->nullable()->default(null);

            $table->string('bank_name')->nullable()->default(null);
            $table->string('bank_branch')->nullable()->default(null);
            $table->string('cc_card')->nullable()->default(null);
            $table->string('gov_id')->nullable()->default(null);
            $table->string('cct_no')->nullable()->default(null);
            $table->string('cct_location')->nullable()->default(null);
            $table->date('cct_date')->nullable()->default(null);

            $table->string('survey_question')->nullable()->default(null);
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
        Schema::dropIfExists('tenants');
    }
}
