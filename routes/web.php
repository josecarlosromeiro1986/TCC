<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['access']], function ()
    {
        Route::resource('stock', 'StockController');

        Route::any('office/search', 'OfficeController@search')->name('office.search');
        Route::resource('office', 'OfficeController');

        Route::any('collaborator/search', 'CollaboratorController@search')->name('collaborator.search');
        Route::any('collaborators', 'CollaboratorController@collaborators')->name('collaborators');

        Route::resource('collaborator', 'CollaboratorController');

        Route::resource('equipment', 'EquipmentController');

        Route::resource('product', 'ProductController');
        Route::any('product/move', 'ProductController@move')->name('product.move');

        Route::get('reports/collaborator', 'ReportsController@collaborator')->name('reports.collaborator');
        Route::get('reports/collaboratorPdf', 'ReportsController@collaboratorPdf')->name('reports.collaboratorPdf');

        Route::get('reports/client', 'ReportsController@client')->name('reports.client');
        Route::get('reports/clientPdf', 'ReportsController@clientPdf')->name('reports.clientPdf');

        Route::get('reports/attendance', 'ReportsController@attendance')->name('reports.attendance');
        Route::get('reports/attendancePdf', 'ReportsController@attendancePdf')->name('reports.attendancePdf');

        Route::get('reports/tatuador', 'ReportsController@tatuador')->name('reports.tatuador');
        Route::get('reports/tatuadorPdf', 'ReportsController@tatuadorPdf')->name('reports.tatuadorPdf');

        Route::get('reports/stock', 'ReportsController@stock')->name('reports.stock');
        Route::get('reports/stockPdf', 'ReportsController@stockPdf')->name('reports.stockPdf');

    });

    Route::resource('typePhone', 'TypePhoneController');

    Route::resource('phone', 'PhoneController');

    Route::any('attendance/status', 'AttendanceController@status')->name('attendance.status');
    Route::any('attendance/search', 'attendanceController@search')->name('attendance.search');
    Route::resource('attendance', 'AttendanceController');

    Route::get('schedule', 'ScheduleController@index')->name('schedule.index');
    Route::put('schedule/up', 'ScheduleController@update')->name('schedule.update');
    Route::any('schedule/search', 'ScheduleController@search')->name('schedule.search');
    Route::any('schedule/collaborator', 'ScheduleController@collaborator')->name('schedule.collaborator');

    Route::any('client/search', 'ClientController@search')->name('client.search');
    Route::resource('client', 'ClientController');
});


Route::get('/', function () {
    return view('index');
})->name('/');

Auth::routes();
