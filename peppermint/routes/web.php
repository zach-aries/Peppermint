<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


/*Route::get('about', 'PagesController@about');

Route::get('/', 'PagesController@home');*/


Auth::routes();

Route::get('/', 'DashboardController@index');

Route::resource('announcements', 'AnnouncementsController');

Route::get('/employees/getmonthhours', 'EmployeeController@getMonthHours');
Route::resource('employees', 'EmployeeController');

Route::post('employees/schedule/{employee}', 'EventController@storeEvent');
Route::post('schedule/{event}', 'EventController@update');
Route::post('schedule/punchin/{event}', 'EventController@punchin');
Route::post('schedule/punchout/{event}', 'EventController@punchout');
Route::get('employees/schedule/{employee}/edit', 'EventController@index');
Route::get('employees/schedule/{employee}/create', 'EventController@createEmployeeEvent');
Route::get('employees/schedule/{employee}/edit/{event}/edit', 'EventController@editEmployeeEvent');
Route::delete('employees/schedule/{employee}/{event}', 'EventController@destroy');

Route::resource('employees/schedule', 'EventController');

Route::get('finances/expenditures/employees', 'EmployeeController@employeesFinance');
Route::get('finances/expenditures/employees/getmonthlyreport', 'EmployeeController@getMonthlyReport');
Route::get('finances/expenditures/employees/getMonthlyReportWage', 'EmployeeController@getMonthlyReportWage');



Route::get('/finances/expenditures/supplies/data', 'SuppliesController@getData');
Route::resource('finances/expenditures/supplies', 'SuppliesController');

Route::resource('finances/invoices/data', 'InvoicesController@getData');
Route::resource('finances/invoices', 'InvoicesController');


