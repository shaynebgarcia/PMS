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

// Route::get('401',['as'=>'401','uses'=>'ErrorController@error401']);
// Route::get('403',['as'=>'403','uses'=>'ErrorController@error403']);
// Route::get('404',['as'=>'404','uses'=>'ErrorController@error404']);
// Route::get('419',['as'=>'419','uses'=>'ErrorController@error419']);
// Route::get('429',['as'=>'429','uses'=>'ErrorController@error429']);
// Route::get('500',['as'=>'500','uses'=>'ErrorController@error500']);
// Route::get('503',['as'=>'503','uses'=>'ErrorController@error503']);

Route::middleware(['auth'])->group(function () {
	
	// Route::get('/access', 'UserController@select')->name('specific.select');
	// Route::post('/access', 'UserController@access')->name('specific.access');

		Route::get('/', 'HomeController@index')->name('dashboard');
		// User Routes
		Route::resource('/user', 'UserController');
		// Tenant Routes
		Route::resource('/tenant', 'TenantController');
		// Property Routes
		Route::get('/property', 'PropertyController@index')->name('property.index');
		Route::get('/property/create', 'PropertyController@create')->name('property.create');
		Route::post('/property', 'PropertyController@store')->name('property.store');
		Route::get('/property/{property}', 'PropertyController@show')->name('property.show');
		// Unit Routes
		Route::get('/unit', 'UnitController@index')->name('unit.index');

		// Leasing Routes
		Route::get('/lease', 'LeasingAgreementController@index')->name('lease.index');
		Route::get('/property/{property}/lease/create', 'LeasingAgreementController@create')->name('lease.create');
		Route::post('/property/{property}/lease', 'LeasingAgreementController@store')->name('lease.store');

			// Leasing Payable Routes
			Route::resource('/lease/{lease}/payable', 'LeasingPayableController');
			// Route::get('/lease/{lease}/payable', 'LeasingPayableController@create')->name('payable.create');
			// Route::post('/lease/{lease}/payable', 'LeasingPayableController@store')->name('payable.store');
			// Leasing Bill Routes
			Route::get('/lease/{lease}/bill/{date}', 'BillingController@display')->name('billing.display');
			Route::post('/lease/{lease}/bill/{date}', 'BillingController@publish')->name('billing.publish');
		// Payment Routes
		Route::resource('/payment', 'PaymentController');
		// Utility Routes
		Route::resource('/utility', 'UtilityController');
			// Utility Billing Routes
			Route::get('/utility/bill/multicreate', 'UtilityBillController@multicreate')->name('utilitybill.multicreate');
			Route::post('/utility/bill/multistore', 'UtilityBillController@multistore')->name('utilitybill.multistore');

		Route::middleware(['has_access'])->group(function () {

			// Property
			Route::get('/property/{property}/edit', 'PropertyController@edit')->name('property.edit');
			Route::patch('/property/{property}', 'PropertyController@update')->name('property.update');
			Route::delete('/property/{property}', 'PropertyController@destroy')->name('property.destroy');
			// Unit
			Route::get('/property/{property}/unit', 'UnitController@create')->name('unit.create');
			Route::post('/property/{property}/unit', 'UnitController@store')->name('unit.store');
			Route::get('/property/{property}/unit/{unit}', 'UnitController@show')->name('unit.show');
			Route::get('/property/{property}/unit/{unit}/edit', 'UnitController@edit')->name('unit.edit');
			Route::patch('/property/{property}/unit/{unit}', 'UnitController@update')->name('unit.update');
			Route::delete('/property/{property}/unit/{unit}', 'UnitController@destroy')->name('unit.destroy');
				// Unit Type Routes
				Route::resource('/property/{property}/unit-type', 'UnitTypeController');

			// Lease
			Route::get('/property/{property}/lease/{lease}', 'LeasingAgreementController@show')->name('lease.show');
			Route::delete('/property/{property}/lease/{lease}', 'LeasingAgreementController@destroy')->name('lease.destroy');
		});



});

