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
	
	Route::get('/', function () {
    	return view('welcome');
	});
	
	Route::get('/home', 'HomeController@index')->name('home');

	// User Routes
	Route::resource('/user', 'UserController');
	// Tenant Routes
	Route::resource('/tenant', 'TenantController');
	// Property Routes
	Route::resource('/property', 'PropertyController');

	// Unit Routes
	Route::get('/unit', 'UnitController@index')->name('unit.index');
	Route::get('/property/{property}/unit', 'UnitController@create')->name('unit.create');
	Route::post('/property/{property}/unit', 'UnitController@store')->name('unit.store');
	Route::get('/property/{property}/unit/{unit}', 'UnitController@show')->name('unit.show');
	Route::get('/property/{property}/unit/{unit}/edit', 'UnitController@edit')->name('unit.edit');
	Route::patch('/property/{property}/unit/{unit}', 'UnitController@update')->name('unit.update');
	Route::delete('/property/{property}/unit/{unit}', 'UnitController@destroy')->name('unit.destroy');
		// Unit Type Routes
		Route::resource('/property/{property}/unit-type', 'UnitTypeController');

	// Leasing Routes
	Route::resource('/lease', 'LeasingAgreementController');
		// Leasing Payable Routes
		Route::resource('/lease/{lease}/payable', 'LeasingPayableController');
		// Route::get('/lease/{lease}/payable', 'LeasingPayableController@create')->name('payable.create');
		// Route::post('/lease/{lease}/payable', 'LeasingPayableController@store')->name('payable.store');
		// Leasing Bill Routes
		Route::get('/lease/{lease}/bill', 'BillingController@display')->name('billing.display');
	// Payment Routes
	Route::resource('/payment', 'PaymentController');
});

