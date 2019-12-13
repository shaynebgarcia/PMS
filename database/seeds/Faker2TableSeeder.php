<?php

use Illuminate\Database\Seeder;
use App\LeasingAgreement;
use App\LeasingAgreementDetail;
use App\Tenant;
use App\User;
use App\Unit;
use App\Service;
use App\Payment;
use App\UtilityBill;
use App\Billing;
use App\BillingDetail;
use App\TenantList;
use Faker\Factory as Faker;

class Faker2TableSeeder extends Seeder
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
            'link_id' => 'LNK-1',
            'property_id' => 5,
    		'unit_id' => 1,
    		// 'tenant_id' => 1,
            // 'tenant_list_id' => 2,
    		'status_id' => 3,

    		'created_at' => Carbon\Carbon::now(),
    	]);

        TenantList::create([
            'leasing_agreement_id' => $lease->id,
            'tenant_id' => 1,
        ]);

        TenantList::create([
            'leasing_agreement_id' => $lease->id,
            'tenant_id' => 2,
        ]);

	    	// Agreement Details
	    	$lease_detail = LeasingAgreementDetail::create([
                'property_id' => 5,
                'agreement_no' => 'AGR-3',
	    		'leasing_agreement_id' => $lease->id,
	    		'description' => 'Original',
	    		'agreed_lease_price' =>  14500.00,
	    		'term_start' => '2019-08-28',
	    		'term_end' => '2020-08-29',
	    		'first_day' => '2019-08-30',
	    		'monthly_due' => 30,
	    		'status_id' => 6,
                'last_billing_my' => date('MY', strtotime('2020-08-29')),

	    		'created_at' => Carbon\Carbon::now(),
	    	]);

            // Updating tenant role
            // $tenant = Tenant::where('id', $lease->tenant_id)->first();
            // $user = User::where('id', $tenant->user_id)->first();
            // $user_updated = $user->update([
            //     'role_id' => 8,
            // ]);

            // Updating unit status
            $unit = Unit::where('id', $lease->unit_id)->first();
            $unit_updated = $unit->update([
                'leasing_agreement_id' => $lease->id,
            ]);

    	// Reservation
    	Payment::create([
            'property_id' => 5,
            'payment_no' => 'PYM-3',
	        'payment_type_id' => 2,
			'leasing_agreement_details_id' => $lease_detail->id,
			'billing_id' => null,

			'tenant_id' => 1,
			'amount_due' => 8000,
			'amount_paid' => 8000,
			'reference_no' => 'OR#09521',
			'note' => null,
			'processed_by_user' => 1,
	        'date_paid' => '2019-08-28',
	        'created_at' => Carbon\Carbon::now(),
    	]);

    	// Full Payment
    	Payment::create([
            'property_id' => 5,
            'payment_no' => 'PYM-4',
	        'payment_type_id' => 3,
			'leasing_agreement_details_id' => $lease_detail->id,
			'billing_id' => null,
			
			'tenant_id' => 1,
			'amount_due' =>  38000.00,
			'amount_paid' => 38000.00,
			'reference_no' => 'OR#09056',
			'note' => 'Deposit slip was handed by '.$faker->name,
			'processed_by_user' => 1,
	        'date_paid' => '2019-08-28',
	        'created_at' => Carbon\Carbon::now(),
    	]);

    	// Services
    	Service::create([
    		'leasing_agreement_details_id' => $lease_detail->id,
    		'service_type_id' => 1,
            'start_date' => '2019-10-20',
            'end_date' => '2020-02-20',
    		'amount' => 1000,
    		'created_at' => Carbon\Carbon::now(),
    	]);
    	Service::create([
    		'leasing_agreement_details_id' => $lease_detail->id,
    		'service_type_id' => 2,
            'start_date' => '2019-10-20',
            'end_date' => '2020-02-20',
    		'amount' => 1000,
    		'created_at' => Carbon\Carbon::now(),
    	]);

    	// Utility Billing
    	UtilityBill::create([
            'property_id' => 5,
    		'leasing_agreement_details_id' => $lease_detail->id,
    		'utility_id' => 1,
    		'to_bill' => 'Oct2019',
            'start_date' => '2019-08-25',
            'end_date' => '2019-09-25',
            'prev_reading' => '1045',
            'pres_reading' => '990',
            'kw_used' => '30',
    		'amount' =>  3076.25,
    		'created_at' => Carbon\Carbon::now(),
    	]);
    	UtilityBill::create([
            'property_id' => 5,
    		'leasing_agreement_details_id' => $lease_detail->id,
    		'utility_id' => 12,
    		'to_bill' => 'Oct2019',
            'start_date' => '2019-09-01',
            'end_date' => '2019-10-01',
            'prev_reading' => '130',
            'pres_reading' => '125',
            'cubic_meter' => '21',
    		'amount' =>  550.00,
    		'created_at' => Carbon\Carbon::now(),
    	]);

    	//Billing
    	$bill = Billing::create([
            'property_id' => 5,
    		'leasing_agreement_details_id' => $lease_detail->id,
    		'invoice_no' => '19X-001',
    		'monthyear' => 'Oct2019',
    		'billing_from' => '2019-09-30',
    		'billing_to' => '2019-10-29',
    		'billing_date' => '2019-09-23',
    		'due_date' => '2019-09-30',
    		'prepared_by' => $faker->name,
    		'subtotal_amount' => 20126.25,
    		'ou_amount' => 0,
    		'total_amount_due' => 20126.25,

    		'created_at' => Carbon\Carbon::now(),
    	]);

	    	BillingDetail::create([
	    		'billing_id' => $bill->id,
                'type' => 'Rental',
	    		'description' => 'Rental',
	    		'amount' => $lease_detail->agreed_lease_price,
	    		'created_at' => Carbon\Carbon::now(),
	    	]);
	    	BillingDetail::create([
	    		'billing_id' => $bill->id,
                'type' => 'Service',
	    		'description' => 'Parking Rental',
	    		'amount' => 1000,
	    		'created_at' => Carbon\Carbon::now(),
	    	]);
	    	BillingDetail::create([
	    		'billing_id' => $bill->id,
                'type' => 'Service',
	    		'description' => 'Elevator Use',
	    		'amount' => 1000,
	    		'created_at' => Carbon\Carbon::now(),
	    	]);
            BillingDetail::create([
                'billing_id' => $bill->id,
                'type' => 'Utility',
                'description' => 'Electricity',
                'amount' => 3076.25,
                'created_at' => Carbon\Carbon::now(),
            ]);
            BillingDetail::create([
                'billing_id' => $bill->id,
                'type' => 'Utility',
                'description' => 'Water',
                'amount' => 550.00,
                'created_at' => Carbon\Carbon::now(),
            ]);

        // Bill Payment
        Payment::create([
            'property_id' => 5,
            'payment_no' => 'PYM-5',
            'payment_type_id' => 1,
            'leasing_agreement_details_id' => $lease_detail->id,
            'billing_id' => $bill->id,
            
            'tenant_id' => 1,
            'amount_due' =>  20126.25,
            'amount_paid' => 20500.00,
            'reference_no' => 'OR#09088',
            'note' => 'Deposit slip was handed by '.$faker->name,
            'processed_by_user' => 1,
            'date_paid' => '2019-10-01',
            'created_at' => Carbon\Carbon::now(),
        ]);

    }
}
