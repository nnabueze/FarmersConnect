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
    return view('front.index');
});

//worker Registration
/*Route::get('/worker', function () {
    return view('worker.create');
});*/

//Route for listing farmers
Route::controller('datatables', 'DatatablesController', [
    'anyData'  => 'datatables.data',
    'getIndex' => 'datatables',
]);
//Route assigning farmer
Route::controller('assign', 'AssignController', [
    'anyData'  => 'assign.data',
    'getIndex' => 'assign',
]);
Route::post('assign','DashboardController@assign');

//Route worker datatable
Route::controller('work', 'DataWorkerController', [
    'anyData'  => 'work.data',
    'getIndex' => 'work',
]);
Route::controller('assignworker', 'AssignWorkerController', [
    'anyData'  => 'assignworker.data',
    'getIndex' => 'assignworker',
]);
Route::post('workerassign','DashboardController@assignWorker');



Route::get('admin/dashboard','DashboardController@index');//Display dashboard
/*Route::get('user','DashboardController@user');*///Display dashboard
Route::get('admin/logout','DashboardController@logout');//Logout from the systems
Route::get('csv','CsvController@csv');
Route::post('csv','CsvController@upload');
Route::get('crops','CsvController@crop');
Route::post('crops','CsvController@addCrop');
Route::delete('crops/{any}','CsvController@deleteCrop');
//workers email confirm
Route::get('email/{token}/{id}/{email}',['as'=>'email','uses'=>'WorkerController@emailConfirm']);
//changing user status
Route::post('status','UserController@status');


////////////////////////ACL///////////////////////////
Route::resource('/admin','AdminController'); //Display Login page
Route::resource('permission','PermissionController');
Route::resource('role','RoleController');
Route::resource('/users','UserController');
/////////////////////////Faermers/////////////////////////
Route::resource('/farmers','FarmerController');
////////////////////////////////////////////////////////////
//worker Registration
Route::resource('/worker','WorkerController');

