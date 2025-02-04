<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AppointmentController as Appointment;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false,
    
]);

Route::get('/', function () {
    return view('index');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(Appointment::class)->group(function () {
    Route::get('/appointment', 'index')->name('appointment');
    Route::get('/appointment/get/dropdownapplication', 'dropDownApplication')->name('dropdown-application');

});