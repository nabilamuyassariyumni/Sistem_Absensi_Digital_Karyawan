<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('employees', EmployeeController::class);
Route::resource('attendances', App\Http\Controllers\AttendanceController::class);
Route::get('/attendances', [AttendanceController::class, 'index'])
    ->name('attendances.index');

Route::post('/attendances/check-in', [AttendanceController::class, 'checkIn'])
    ->name('attendances.checkin');

Route::post('/attendances/check-out', [AttendanceController::class, 'checkOut'])
    ->name('attendances.checkout');

Route::get('attendances-report', [AttendanceController::class, 'monthlyReport'])->name('attendances.monthly-report');
