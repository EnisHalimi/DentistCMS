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
Route::get('/notifications', 'HomeController@notifications');
Route::get('/notificationsDatatable', 'HomeController@getNotificationsDataTable');
Route::get('getPacients', 'HomeController@autocomplete');
Route::get('/searchPacient', 'SearchController@searchPacient');
Route::get('/searchUser', 'SearchController@searchUser');
Route::get('/searchVisit', 'SearchController@searchVisit');
Route::get('/searchService', 'SearchController@searchService');
Route::get('search', 'SearchController@search');
Route::get('/pacientDatatable', 'PacientController@getPacientDataTable');
Route::get('/userDatatable', 'UserController@getUserDataTable');
Route::get('/appointmentDatatable', 'AppointmentController@getAppointmentDataTable');
Route::get('/visitDatatable', 'VisitController@getVisitDataTable');
Route::get('/treatmentDatatable', 'TreatmentController@getTreatmentDataTable');
Route::get('/serviceDatatable', 'ServicesController@getServiceDataTable');
