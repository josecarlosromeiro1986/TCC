<?php

use Illuminate\Support\Facades\Route;

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
Route::any('office/search', 'OfficeController@search')->name('office.search');
Route::resource('office', 'OfficeController');

Route::any('collaborator/search', 'CollaboratorController@search')->name('collaborator.search');
Route::resource('collaborator', 'CollaboratorController');

Route::any('client/search', 'ClientController@search')->name('client.search');
Route::resource('client', 'ClientController');

Route::resource('typePhone', 'TypePhoneController');
Route::resource('phone', 'PhoneController');
Route::resource('attendance', 'AttendanceController');
Route::resource('schedule', 'ScheduleController');

Route::get('home', function () {
    return view('index');
})->name('home');
