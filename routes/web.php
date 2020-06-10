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

Route::get('/', 'HomeController@index');
Auth::routes(['register' => false]);
Route::resource('appointment', 'AppointmentController');
Route::resource('contact', 'ContactController');
Route::resource('pacient', 'PacientController');
Route::resource('report', 'ReportController');
Route::resource('services', 'ServicesController');
Route::resource('treatment', 'TreatmentController');
Route::resource('user', 'UserController');
Route::resource('visit', 'VisitController');
Route::resource('debt', 'DebtController');
Route::resource('role', 'RoleController');
Route::resource('bill', 'BillController');
Route::resource('payment', 'PaymentController');
Route::get('/notifications', 'HomeController@notifications');
Route::get('/calendar', 'HomeController@calendar');
Route::get('/daily', 'HomeController@daily');
Route::get('/company', 'HomeController@company');
Route::post('/company/save', 'HomeController@companySave');
Route::get('/notificationsDatatable', 'HomeController@getNotificationsDataTable');
Route::get('getPacients', 'HomeController@autocomplete');
Route::get('/searchPacient', 'SearchController@searchPacient');
Route::get('/searchUser', 'SearchController@searchUser');
Route::get('/searchTreatment', 'SearchController@searchTreatment');
Route::get('/searchService', 'SearchController@searchService');
Route::get('/searchServicePayment', 'SearchController@searchServicePayment');
Route::get('search', 'SearchController@search');
Route::get('/pacientDatatable', 'PacientController@getPacientDataTable');
Route::get('/userDatatable', 'UserController@getUserDataTable');
Route::get('/appointmentDatatable', 'AppointmentController@getAppointmentDataTable');
Route::get('/visitDatatable', 'VisitController@getVisitDataTable');
Route::get('/treatmentDatatable', 'TreatmentController@getTreatmentDataTable');
Route::get('/reportDatatable', 'ReportController@getReportDataTable');
Route::get('/serviceDatatable', 'ServicesController@getServiceDataTable');
Route::get('/debtDatatable', 'DebtController@getDebtDataTable');
Route::get('/roleDatatable', 'RoleController@getRoleDataTable');
Route::get('/billDatatable', 'BillController@getBillDataTable');
Route::get('/paymentDatatable', 'PaymentController@getPaymentDataTable');
Route::get('raporti', 'ReportController@raporti');
Route::get('fatura', 'PaymentController@fatura');
Route::post('/markAsRead', 'HomeController@markAsRead');
Route::get('/getAppointments', 'HomeController@getAppointments' );
Route::post('/addCart', 'HomeController@addToCart' );
Route::post('/updateCart', 'HomeController@updateToCart' );
Route::post('/deleteCart', 'HomeController@deleteFromCart' );
Route::get('/backup', 'HomeController@backup' );