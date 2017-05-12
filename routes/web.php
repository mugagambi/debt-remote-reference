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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/customers', 'CustomerController@index')->name('customers');

Route::get('/customers/list', 'CustomerController@customers_list')->name('customers-list');

Route::get('/customers/create', 'CustomerController@create')->name('customer-create');

Route::post('/customers/create', 'CustomerController@store')->name('customer-store');

Route::get('/customers/{profile}/edit', 'CustomerController@edit')->name('customer-edit');

Route::post('/customers/', 'CustomerController@store_update')->name('customer-store-edited');

Route::get('/customers/{profile}', 'CustomerController@destroy')->name('customer-delete');

Route::get('/downloadExcel/{type}', 'DueListingController@downloadExcelFile')->middleware('role')->name('downloadExcel');

Route::get('/debtors/report', 'DueListingController@index')->middleware('role')->name('debtors-report');

Route::get('/debtors/list', 'DueListingController@debtors_list')->middleware('role')->name('debtors-list');

Route::get('/debt/status/{profile}', 'DueListingController@debt_status')->name('debt_status');

Route::get('/debt/status', 'DueListingController@find_customer_debt_status')->name('find_customer');

Route::post('/debt/status', 'DueListingController@search_debt')->name('search_customer');

