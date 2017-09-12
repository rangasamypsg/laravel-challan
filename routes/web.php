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
    //return view('welcome');
	return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Department resource 	
Route::get('departments', ['as' => 'Department.index' , 'uses' => 'DepartmentController@index']);
Route::get('department/create', ['as' => 'Department.create' , 'uses' => 'DepartmentController@create']);
Route::post('department/store', ['as' => 'Department.store' , 'uses' => 'DepartmentController@store']);
Route::get('department/show/{id}', ['as' => 'Department.show' , 'uses' => 'DepartmentController@show']);
Route::get('department/{id}/edit', ['as' => 'Department.edit' , 'uses' => 'DepartmentController@edit']);
Route::post('department/update/{id}', ['as' => 'Department.update' , 'uses' => 'DepartmentController@update']);
Route::delete('department/destroy/{id}', ['as' => 'Department.destroy' , 'uses' => 'DepartmentController@destroy']);

//UOM resource 
Route::get('uoms', ['as' => 'Uom.index' , 'uses' => 'UomController@index']);
Route::get('uom/create', ['as' => 'Uom.create' , 'uses' => 'UomController@create']);
Route::post('uom/store', ['as' => 'Uom.store' , 'uses' => 'UomController@store']);
Route::get('uom/show/{id}', ['as' => 'Uom.show' , 'uses' => 'UomController@show']);
Route::get('uom/{id}/edit', ['as' => 'Uom.edit' , 'uses' => 'UomController@edit']);
Route::post('uom/update/{id}', ['as' => 'Uom.update' , 'uses' => 'UomController@update']);
Route::delete('uom/destroy/{id}', ['as' => 'Uom.destroy' , 'uses' => 'UomController@destroy']);

//DeliveryType resource 
Route::get('delivery_types', ['as' => 'DeliveryType.index' , 'uses' => 'DeliveryTypeController@index']);
Route::get('delivery_type/create', ['as' => 'DeliveryType.create' , 'uses' => 'DeliveryTypeController@create']);
Route::post('delivery_type/store', ['as' => 'DeliveryType.store' , 'uses' => 'DeliveryTypeController@store']);
Route::get('delivery_type/show/{id}', ['as' => 'DeliveryType.show' , 'uses' => 'DeliveryTypeController@show']);
Route::get('delivery_type/{id}/edit', ['as' => 'DeliveryType.edit' , 'uses' => 'DeliveryTypeController@edit']);
Route::post('delivery_type/update/{id}', ['as' => 'DeliveryType.update' , 'uses' => 'DeliveryTypeController@update']);
Route::delete('delivery_type/destroy/{id}', ['as' => 'DeliveryType.destroy' , 'uses' => 'DeliveryTypeController@destroy']);

//Indentor resource 
Route::get('indentors', ['as' => 'Indentor.index' , 'uses' => 'IndentorController@index']);
Route::get('indentor/create', ['as' => 'Indentor.create' , 'uses' => 'IndentorController@create']);
Route::post('indentor/store', ['as' => 'Indentor.store' , 'uses' => 'IndentorController@store']);
Route::get('indentor/show/{id}', ['as' => 'Indentor.show' , 'uses' => 'IndentorController@show']);
Route::get('indentor/{id}/edit', ['as' => 'Indentor.edit' , 'uses' => 'IndentorController@edit']);
Route::post('indentor/update/{id}', ['as' => 'Indentor.update' , 'uses' => 'IndentorController@update']);
Route::delete('indentor/destroy/{id}', ['as' => 'Indentor.destroy' , 'uses' => 'IndentorController@destroy']);

//Vendor resource 
Route::get('vendors', ['as' => 'Vendor.index' , 'uses' => 'VendorController@index']);
Route::get('vendor/create', ['as' => 'Vendor.create' , 'uses' => 'VendorController@create']);
Route::post('vendor/store', ['as' => 'Vendor.store' , 'uses' => 'VendorController@store']);
Route::get('vendor/show/{id}', ['as' => 'Vendor.show' , 'uses' => 'VendorController@show']);
Route::get('vendor/{id}/edit', ['as' => 'Vendor.edit' , 'uses' => 'VendorController@edit']);
Route::post('vendor/update/{id}', ['as' => 'Vendor.update' , 'uses' => 'VendorController@update']);
Route::delete('vendor/destroy/{id}', ['as' => 'Vendor.destroy' , 'uses' => 'VendorController@destroy']);	

//DeliveryNote resource 
Route::get('delivery_notes', ['as' => 'DeliveryNote.index' , 'uses' => 'DeliveryNoteController@index']);
Route::get('delivery_note/create', ['as' => 'DeliveryNote.create' , 'uses' => 'DeliveryNoteController@create']);
Route::post('delivery_note/store', ['as' => 'DeliveryNote.store' , 'uses' => 'DeliveryNoteController@store']);
Route::get('delivery_note/show/{id}', ['as' => 'DeliveryNote.show' , 'uses' => 'DeliveryNoteController@show']);
Route::get('delivery_note/{id}/edit', ['as' => 'DeliveryNote.edit' , 'uses' => 'DeliveryNoteController@edit']);
Route::post('delivery_note/update/{id}', ['as' => 'DeliveryNote.update' , 'uses' => 'DeliveryNoteController@update']);
Route::delete('delivery_note/destroy/{id}', ['as' => 'DeliveryNote.destroy' , 'uses' => 'DeliveryNoteController@destroy']);
Route::get('delivery_note/show_bill_details/{id}', ['as' => 'DeliveryNote.showBillDetail' , 'uses' => 'DeliveryNoteController@showBillDetails']);
Route::get('delivery_notes/returnable_reports', ['as' => 'DeliveryNote.showReturnableReports' , 'uses' => 'DeliveryNoteController@showReturnableReports']);
Route::get('delivery_notes/not_returnable_reports', ['as' => 'DeliveryNote.showNonReturnableReports' , 'uses' => 'DeliveryNoteController@showNonReturnableReports']);
Route::get('delivery_notes/deliver_note_report', ['as' => 'DeliveryNote.showDeliveryNoteReports' , 'uses' => 'DeliveryNoteController@showDeliveryNoteReports']);

//DeliveryNote ajax routes...
Route::post('delivery_note/department', ['as' => 'DeliveryNote.department', 'uses' => 'DeliveryNoteController@getDepartmentList']);
Route::post('delivery_note/vendor_list', ['as' => 'DeliveryNote.vendor', 'uses' => 'DeliveryNoteController@getVendorList']);
Route::post('delivery_note/material', ['as' => 'DeliveryNote.material', 'uses' => 'DeliveryNoteController@getMaterialList']);

//Page not found
Route::get('pagenotfound', ['as' => 'notfound', 'uses' => 'HomeController@pagenotfound']);	