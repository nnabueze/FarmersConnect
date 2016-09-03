<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


//Route for listing farmers
Route::controller('datatables', 'DatatablesController', [
    'anyData'  => 'datatables.data',
    'getIndex' => 'datatables',
]);
//Route assigning farmer


Route::get('admin/dashboard','DashboardController@index');//Display dashboard
/*Route::get('user','DashboardController@user');*///Display dashboard
Route::get('admin/logout','DashboardController@logout');//Logout from the systems


////////////////////////ACL///////////////////////////
Route::resource('/admin','AdminController'); //Display Login page
Route::resource('permission','PermissionController');
Route::resource('role','RoleController');
Route::resource('/users','UserController');
/////////////////////////Faermers/////////////////////////
Route::resource('/farmers','FarmerController');

