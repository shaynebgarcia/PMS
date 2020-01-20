<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::middleware(['guest'])->group(function () {
	// return redirect()->route('login');
	Route::get('/occupant/form', 'OccupantsController@create')->name('occupant.create');
	Route::post('/occupant/form', 'OccupantsController@store')->name('occupant.store');
});

Route::group(['middleware' => ['has_access']], function () {

	Route::middleware(['auth'])->group(function () {

			Route::get('/', 'HomeController@index')->name('dashboard');
			Route::get('/switch-property', 'HomeController@switch')->name('property.switch');
			Route::post('/switch-property', 'HomeController@regen')->name('property.regen');

			// AJAX
			Route::get('/getUtilities', 'UtilityController@getUtilities');
			Route::get('/getTerm', 'LeasingAgreementController@getTerm');
			Route::get('/getInventory', 'InventoryController@getInventory');
			Route::get('/getStock', 'InventoryController@getStock');
			Route::get('/processList', 'JobOrderProcessingController@processList');
			Route::post('/process', 'JobOrderProcessingController@process');
			Route::delete('/process/destroy', 'JobOrderProcessingController@destroy');

			// User Routes
			Route::group(['middleware' => ['permission:List User']], function () {
		        Route::get('/user', 'UserController@index')->name('user.index');
		    });
			Route::group(['middleware' => ['permission:Create User']], function () {
		        Route::get('/user/create', 'UserController@create')->name('user.create');
				Route::post('/user/create', 'UserController@store')->name('user.store');
		    });
		    Route::group(['middleware' => ['permission:List User']], function () {
		        Route::get('/user/{user}', 'UserController@show')->name('user.show');
		    });
			Route::group(['middleware' => ['permission:Update User']], function () {
		        Route::get('/user/{user}/edit', 'UserController@edit')->name('user.edit');
				Route::patch('/user/{user}', 'UserController@update')->name('user.update');
		    });
			Route::group(['middleware' => ['permission:Delete User']], function () {
		        Route::delete('/user/{user}', 'UserController@destroy')->name('user.destroy');
		    });
			
			
			// Tenant Routes
			// Route::resource('/tenant', 'TenantController');
			Route::group(['middleware' => ['permission:List Tenant']], function () {
		        Route::get('/tenant', 'TenantController@index')->name('tenant.index');
		    });
			Route::group(['middleware' => ['permission:Create Tenant']], function () {
		        Route::get('/tenant/create', 'TenantController@create')->name('tenant.create');
				Route::post('/tenant', 'TenantController@store')->name('tenant.store');
		    });
		    Route::group(['middleware' => ['permission:List Tenant']], function () {
				Route::get('/tenant/{tenant}', 'TenantController@show')->name('tenant.show');
		    });
			Route::group(['middleware' => ['permission:Update Tenant']], function () {
		        Route::get('/tenant/{tenant}/edit', 'TenantController@edit')->name('tenant.edit');
				Route::patch('/tenant/{tenant}', 'TenantController@update')->name('tenant.update');
		    });
			Route::group(['middleware' => ['permission:Delete Tenant']], function () {
		        Route::delete('/tenant/{tenant}', 'TenantController@destroy')->name('tenant.destroy');
		    });

			// Property Routes
			Route::group(['middleware' => ['permission:List Property']], function () {
		        Route::get('/property', 'PropertyController@index')->name('property.index');
		    });
			Route::group(['middleware' => ['permission:Create Property']], function () {
		        Route::get('/property/create', 'PropertyController@create')->name('property.create');
				Route::post('/property', 'PropertyController@store')->name('property.store');
		    });
			
			// Unit Routes

			// Payment Routes
			Route::group(['middleware' => ['permission:List Payment']], function () {
		        Route::get('/payment', 'PaymentController@index')->name('payment.index');
		    });
			Route::group(['middleware' => ['permission:Create Payment']], function () {
		        Route::get('/payment/create', 'PaymentController@create')->name('payment.create');
				Route::post('/payment', 'PaymentController@store')->name('payment.store');
		    });
		    Route::group(['middleware' => ['permission:Update Payment']], function () {
		        Route::get('/payment/{payment}/edit', 'PaymentController@edit')->name('payment.edit');
				Route::patch('/payment/{payment}', 'PaymentController@update')->name('payment.update');
		    });
		    Route::group(['middleware' => ['permission:Delete Payment']], function () {
				Route::delete('/payment/{payment}', 'PaymentController@destroy')->name('payment.destroy');
		    });
		    Route::group(['middleware' => ['permission:List Payment']], function () {
		        Route::get('/payment/{payment}', 'PaymentController@show')->name('payment.show');
		    });

		    // Inventory Routes
			Route::resource('/inventory', 'InventoryController');
			Route::patch('/restock', 'InventoryController@restock')->name('inventory.restock');
			Route::patch('/reduce', 'InventoryController@reduce')->name('inventory.reduce');

			// Inventory Routes
			Route::resource('/orders', 'JobOrderController');

			// Route::middleware(['has_access'])->group(function () {

			// 	// Property
			// 	Route::group(['middleware' => ['permission:List Property']], function () {
			//         Route::get('/property/{property}', 'PropertyController@show')->name('property.show');
			//     });
			// 	Route::group(['middleware' => ['permission:Update Property']], function () {
			//         Route::get('/property/{property}/edit', 'PropertyController@edit')->name('property.edit');
			// 		Route::patch('/property/{property}', 'PropertyController@update')->name('property.update');
			//     });
			// 	Route::group(['middleware' => ['permission:Delete Property']], function () {
			//         Route::delete('/property/{property}', 'PropertyController@destroy')->name('property.destroy');
			//     });
				
			// 	// Unit
			// 	Route::get('/property/{property}/unit/create', 'UnitController@create')->name('unit.create');
			// 	Route::post('/property/{property}/unit', 'UnitController@store')->name('unit.store');
			// 	Route::get('/property/{property}/unit/{unit}/edit', 'UnitController@edit')->name('unit.edit');
			// 	Route::patch('/property/{property}/unit/{unit}', 'UnitController@update')->name('unit.update');
			// 	Route::delete('/property/{property}/unit/{unit}', 'UnitController@destroy')->name('unit.destroy');
			// 		// Unit Type Routes
			// 		Route::resource('/property/{property}/unit-type', 'UnitTypeController');

			// 	// Leasing Routes
			// 	Route::get('/property/{property}/lease', 'LeasingAgreementController@index')->name('lease.index');
			// 	Route::get('/property/{property}/lease/create', 'LeasingAgreementController@create')->name('lease.create');
			// 	Route::post('/property/{property}/lease', 'LeasingAgreementController@store')->name('lease.store');
			// 	Route::get('/property/{property}/lease/{link}', 'LeasingAgreementController@show')->name('lease.show');
			// 	Route::delete('/property/{property}/lease/{link}/{lease}', 'LeasingAgreementController@destroy')->name('lease.destroy');
			// 	Route::get('/property/{property}/lease/{link}/renew', 'LeasingAgreementController@renewform')->name('lease.renewform');
			// 	Route::post('/property/{property}/lease/{link}/renew', 'LeasingAgreementController@renew')->name('lease.renew');
			// 	Route::get('/property/{property}/lease/{link}/{lease}/export', 'LeasingAgreementController@exportPDF_contract')->name('export.contract');

			// 		// Leasing Bill Routes
			// 		Route::get('/property/{property}/billing', 'BillingController@index')->name('billing.index');
			// 		Route::get('/property/{property}/billing/{date}', 'BillingController@date')->name('billing.group.date');
			// 		Route::get('/property/{property}/lease/{link}/{lease}/billing', 'BillingController@group')->name('billing.group.lease');
			// 		Route::get('/property/{property}/lease/{link}/{lease}/billing/{date}', 'BillingController@display')->name('billing.display');
			// 		Route::post('/property/{property}/lease/{link}/{lease}/billing/{date}', 'BillingController@publish')->name('billing.publish');
			// 		Route::get('/property/{property}/lease/{link}/{lease}/billing/{bill}/export', 'BillingController@exportPDF_invoice')->name('export.invoice');

			// 	// Utility Routes
			// 	Route::resource('/property/{property}/utilities', 'UtilityController');

			// 		// Utility Billing Routes
			// 		Route::get('/property/{property}/utility-bill', 'UtilityBillController@index')->name('utility-bill.index');
			// 		Route::get('/property/{property}/lease/{link}/{lease}/utility-bill', 'UtilityBillController@group')->name('utility-bill.group.lease');

			// 	// Attach Payments
			// 	Route::get('/property/{property}/lease/{link}/{lease}/payment', 'PaymentController@group')->name('payment.group.lease');
			// 	Route::patch('/property/{property}/lease/{link}/{lease}/payment', 'PaymentController@attach')->name('payment.attach');
			// 	// Other Income Routes
			// 	Route::get('/property/{property}/lease/{link}/{lease}/other-income', 'OtherIncomeController@group')->name('oincome.group.lease');
			// 	Route::post('/property/{property}/lease/{link}/{lease}/other-income', 'OtherIncomeController@store')->name('oincome.store');
			// 		// Other Income Routes
			// 		Route::resource('/property/{property}/other-income-type', 'OtherIncomeTypeController');
			// });

			Route::group(['middleware' => ['web']], function () {

				// Property
				Route::group(['middleware' => ['permission:List Property']], function () {
			        Route::get('/property/{property}', 'PropertyController@show')->name('property.show');
			    });
				Route::group(['middleware' => ['permission:Update Property']], function () {
			        Route::get('/property/{property}/edit', 'PropertyController@edit')->name('property.edit');
					Route::patch('/property/{property}', 'PropertyController@update')->name('property.update');
			    });
				Route::group(['middleware' => ['permission:Delete Property']], function () {
			        Route::delete('/property/{property}', 'PropertyController@destroy')->name('property.destroy');
			    });
				
				// Unit
				Route::get('/unit', 'UnitController@index')->name('unit.index');
				Route::get('/unit/create', 'UnitController@create')->name('unit.create');
				Route::post('/unit', 'UnitController@store')->name('unit.store');
				Route::get('/unit/{unit}/edit', 'UnitController@edit')->name('unit.edit');
				Route::patch('/unit/{unit}', 'UnitController@update')->name('unit.update');
				Route::delete('/unit/{unit}', 'UnitController@destroy')->name('unit.destroy');
					// Unit Type Routes
					Route::resource('/unit-type', 'UnitTypeController');

				// Leasing Routes
				Route::get('/lease', 'LeasingAgreementController@index')->name('lease.index');
				Route::get('/lease/create', 'LeasingAgreementController@create')->name('lease.create');
				Route::post('/lease', 'LeasingAgreementController@store')->name('lease.store');
				Route::get('/lease/{link}', 'LeasingAgreementController@show')->name('lease.show');
				Route::delete('/lease/{link}/{lease}', 'LeasingAgreementController@destroy')->name('lease.destroy');
				Route::get('/lease/{link}/renew', 'LeasingAgreementController@renewform')->name('lease.renewform');
				Route::post('/lease/{link}/renew', 'LeasingAgreementController@renew')->name('lease.renew');
				Route::get('/lease/{link}/{lease}/export', 'LeasingAgreementController@exportPDF_contract')->name('export.contract');

					// Leasing Bill Routes
					Route::get('/billing', 'BillingController@index')->name('billing.index');
					Route::get('/billing/{date}', 'BillingController@date')->name('billing.group.date');
					Route::get('/lease/{link}/{lease}/billing', 'BillingController@group')->name('billing.group.lease');
					Route::get('/lease/{link}/{lease}/billing/{date}', 'BillingController@display')->name('billing.display');
					Route::post('/lease/{link}/{lease}/billing/{date}', 'BillingController@publish')->name('billing.publish');
					Route::get('/lease/{link}/{lease}/billing/{bill}/export', 'BillingController@exportPDF_invoice')->name('export.invoice');

				// Utility Routes
				Route::resource('/utilities', 'UtilityController');

					// Utility Billing Routes
					Route::get('/utility-bill', 'UtilityBillController@index')->name('utility-bill.index');
					Route::post('/utility-bill', 'UtilityBillController@store')->name('utility-bill.store');
					Route::patch('/utility-bill/{bill}', 'UtilityBillController@update')->name('utility-bill.update');
					Route::get('/lease/{link}/{lease}/utility-bill', 'UtilityBillController@group')->name('utility-bill.group.lease');

				// Services Routes
				Route::resource('/services', 'ServiceController');
				Route::resource('/service-type', 'ServiceTypeController');
				Route::get('/lease/{link}/{lease}/service-bill', 'ServiceController@group')->name('service.group.lease');

				// Attach Payments
				Route::get('/lease/{link}/{lease}/payment', 'PaymentController@group')->name('payment.group.lease');
				Route::patch('/lease/{link}/{lease}/payment', 'PaymentController@attach')->name('payment.attach');
				// Other Income Routes
				Route::get('/lease/{link}/{lease}/other-income', 'OtherIncomeController@group')->name('oincome.group.lease');
				Route::post('/lease/{link}/{lease}/other-income', 'OtherIncomeController@store')->name('oincome.store');
					// Other Income Routes
					Route::resource('/other-income-type', 'OtherIncomeTypeController');
			});

	});

});

