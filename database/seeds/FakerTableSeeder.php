<?php

use Illuminate\Database\Seeder;
use App\LeasingAgreement;
use App\LeasingAgreementDetail;
use App\Payment;
use Faker\Factory as Faker;

class FakerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();

    	// Agreement
    	$lease = LeasingAgreement::create([
    		'link_id' => '22-1',
    		'property_id' => 5,
    		'unit_id' => 2,
    		'tenant_id' => 2,
    		'agreement_status_id' => 1,
    		'created_at' => Carbon\Carbon::now(),
    	]);
	    	// Agreement Details
    		$orig_lease_detail = LeasingAgreementDetail::create([
	    		'agreement_no' => 'AGR-0000',
	    		'leasing_agreement_id' => $lease->id,
	    		'description' => 'Original',
	    		'agreed_lease_price' =>  11000.00,
	    		'term_start' => '2018-10-15',
	    		'term_end' => '2019-10-16',
	    		'first_day' => '2018-10-21',
	    		'monthly_due' => 22,
	    		'status' => 'Expired',
	    		'last_billing_my' => date('MY', strtotime('2019-10-16')),

	    		'created_at' => '2018-10-15 07:38:21',
	    	]);
	    	$lease_detail = LeasingAgreementDetail::create([
	    		'agreement_no' => 'AGR-0001',
	    		'leasing_agreement_id' => $lease->id,
	    		'description' => 'Renewed',
	    		'agreed_lease_price' =>  12000.00,
	    		'term_start' => '2019-10-15',
	    		'term_end' => '2020-10-16',
	    		'first_day' => '2019-10-21',
	    		'monthly_due' => 22,
	    		'status' => 'Active',
	    		'last_billing_my' => date('MY', strtotime('2020-10-16')),

	    		'created_at' => Carbon\Carbon::now(),
	    	]);


    	// Reservation
    	Payment::create([
    		'property_id' => 5,
	        'payment_type_id' => 2,
			'leasing_agreement_details_id' => $orig_lease_detail->id,
			'billing_id' => null,

			'tenant_id' => 2,
			'amount_due' => 8000,
			'amount_paid' => 8000,
			'reference_no' => 'OR#08424',
			'note' => null,
			'processed_by_user' => 1,
	        'slug' => 'PYM-0001',
	        'date_paid' => '2019-10-12',
	        'created_at' => Carbon\Carbon::now(),
	        'updated_at' => Carbon\Carbon::now(),
    	]);

    	// Full Payment
    	Payment::create([
    		'property_id' => 5,
	        'payment_type_id' => 3,
			'leasing_agreement_details_id' => $orig_lease_detail->id,
			'billing_id' => null,
			
			'tenant_id' => 2,
			'amount_due' =>  33500.00,
			'amount_paid' => 33500.00,
			'reference_no' => 'OR#08567',
			'note' => 'Paid via bank deposit on the same date as reservation',
			'processed_by_user' => 1,
	        'slug' => 'PYM-0002',
	        'date_paid' => '2019-10-12',
	        'created_at' => Carbon\Carbon::now(),
	        'updated_at' => Carbon\Carbon::now(),
    	]);

    }
}
