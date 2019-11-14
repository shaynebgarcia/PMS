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
});

Route::middleware(['auth'])->group(function () {

		Route::get('/', 'HomeController@index')->name('dashboard');
		// User Routes
		Route::resource('/user', 'UserController');
		// Tenant Routes
		Route::resource('/tenant', 'TenantController');
		// Property Routes
		Route::get('/property', 'PropertyController@index')->name('property.index');
		Route::get('/property/create', 'PropertyController@create')->name('property.create');
		Route::post('/property', 'PropertyController@store')->name('property.store');
		// Unit Routes

		// Payment Routes
		Route::resource('/payment', 'PaymentController');
			// Leasing Payable Routes
			// Route::resource('/lease/{lease}/payable', 'LeasingPayableController');

		Route::middleware(['has_access'])->group(function () {

			// Property
			Route::get('/property/{property}', 'PropertyController@show')->name('property.show');
			Route::get('/property/{property}/edit', 'PropertyController@edit')->name('property.edit');
			Route::patch('/property/{property}', 'PropertyController@update')->name('property.update');
			Route::delete('/property/{property}', 'PropertyController@destroy')->name('property.destroy');
			// Unit
			Route::get('/property/{property}/unit/create', 'UnitController@create')->name('unit.create');
			Route::post('/property/{property}/unit', 'UnitController@store')->name('unit.store');
			Route::get('/property/{property}/unit/{unit}/edit', 'UnitController@edit')->name('unit.edit');
			Route::patch('/property/{property}/unit/{unit}', 'UnitController@update')->name('unit.update');
			Route::delete('/property/{property}/unit/{unit}', 'UnitController@destroy')->name('unit.destroy');
				// Unit Type Routes
				Route::resource('/property/{property}/unit-type', 'UnitTypeController');

			// Leasing Routes
			Route::get('/property/{property}/lease', 'LeasingAgreementController@index')->name('lease.index');
			Route::get('/property/{property}/lease/create', 'LeasingAgreementController@create')->name('lease.create');
			Route::post('/property/{property}/lease', 'LeasingAgreementController@store')->name('lease.store');
			Route::get('/property/{property}/lease/{link}', 'LeasingAgreementController@show')->name('lease.show');
			Route::delete('/property/{property}/lease/{link}/{lease}', 'LeasingAgreementController@destroy')->name('lease.destroy');
			Route::get('/property/{property}/lease/{link}/{lease}/renew', 'LeasingAgreementController@renewform')->name('lease.renewform');
			Route::post('/property/{property}/lease/{link}/{lease}/renew', 'LeasingAgreementController@renew')->name('lease.renew');
			Route::get('/property/{property}/lease/{link}/{lease}/export', 'LeasingAgreementController@exportPDF_contract')->name('export.contract');

				// Leasing Bill Routes
				Route::get('/property/{property}/billing', 'BillingController@index')->name('billing.index');
				Route::get('/property/{property}/billing/{date}', 'BillingController@date')->name('billing.group.date');
				Route::get('/property/{property}/lease/{link}/{lease}/billing', 'BillingController@group')->name('billing.group.lease');
				Route::get('/property/{property}/lease/{link}/{lease}/billing/{date}', 'BillingController@display')->name('billing.display');
				Route::post('/property/{property}/lease/{link}/{lease}/billing/{date}', 'BillingController@publish')->name('billing.publish');
				Route::get('/property/{property}/lease/{link}/{lease}/billing/{bill}/export', 'BillingController@exportPDF_invoice')->name('export.invoice');

			// Utility Routes
			Route::resource('/property/{property}/utility', 'UtilityController');
				// Utility Billing Routes
				Route::get('/property/{property}/utility/bill/multicreate', 'UtilityBillController@multicreate')->name('utilitybill.multicreate');
				Route::post('/property/{property}/utility/bill/multistore', 'UtilityBillController@multistore')->name('utilitybill.multistore');
			// Other Income Routes
			Route::get('/property/{property}/lease/{link}/{lease}/oincome', 'OtherIncomeController@group')->name('oincome.group.lease');
			Route::post('/property/{property}/lease/{link}/{lease}/oincome', 'OtherIncomeController@store')->name('oincome.store');
				// Other Income Routes
				Route::resource('/property/{property}/oincome-type', 'OtherIncomeTypeController');
		});



});

