<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'loginForm'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::middleware('role:hr')->group(function () {

    Route::get('/dashboard/hr', [DashboardController::class, 'index'])
        ->name('dashboard.hr');

    Route::resource('employees', EmployeeController::class);

    Route::get('/overtime-report', [DashboardController::class, 'overtimeReport'])
        ->name('overtime.report');

    Route::get('/attendance-data', [DashboardController::class, 'attendanceData'])
        ->name('attendances.admin');

    Route::get('/monthly-report', [DashboardController::class, 'monthlyReport'])
        ->name('monthly.report');

    Route::get(
        '/monthly-report/export-csv',
        [DashboardController::class, 'exportCsv']
    )->name('monthly.report.excel');

    Route::get('/monthly-report/pdf', [DashboardController::class, 'exportPdf'])
        ->name('monthly.report.pdf');
});

Route::middleware('role:employee')->group(function () {

    Route::get('/dashboard/employee', [EmployeeDashboardController::class, 'index'])
        ->name('dashboard.employee');

    Route::resource('attendances', AttendanceController::class);

    Route::post('/attendances/check-in', [AttendanceController::class, 'checkIn'])
        ->name('attendances.checkin');

    Route::post('/attendances/check-out', [AttendanceController::class, 'checkOut'])
        ->name('attendances.checkout');

    Route::get('/attendances-report', [AttendanceController::class, 'monthlyReport'])
        ->name('attendances.monthly-report');

    Route::get('/attendance-history', [AttendanceController::class, 'history'])
        ->name('attendances.history');
});
