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
Route::resource('daljet', 'DaljeController');
Route::get('/notifications', 'HomeController@notifications');
Route::get('/settings', 'HomeController@settings');
Route::get('/settings/edit', 'HomeController@settingsEdit');
Route::post('/settings/save', 'HomeController@settingsSave');
Route::get('/notificationsDatatable', 'HomeController@getNotificationsDataTable');
Route::get('getPacients', 'HomeController@autocomplete');
Route::get('/searchPacient', 'SearchController@searchPacient');
Route::get('/searchUser', 'SearchController@searchUser');
Route::get('/searchVisit', 'SearchController@searchVisit');
Route::get('/searchTreatment', 'SearchController@searchTreatment');
Route::get('/searchService', 'SearchController@searchService');
Route::get('search', 'SearchController@search');
Route::get('/pacientDatatable', 'PacientController@getPacientDataTable');
Route::get('/userDatatable', 'UserController@getUserDataTable');
Route::get('/appointmentDatatable', 'AppointmentController@getAppointmentDataTable');
Route::get('/visitDatatable', 'VisitController@getVisitDataTable');
Route::get('/treatmentDatatable', 'TreatmentController@getTreatmentDataTable');
Route::get('/reportDatatable', 'ReportController@getReportDataTable');
Route::get('/serviceDatatable', 'ServicesController@getServiceDataTable');
Route::get('/daljeDatatable', 'DaljeController@getDaljeDataTable');
Route::get('pdf', 'ReportController@pdf');
Route::post('/markAsRead', 'HomeController@markAsRead');
