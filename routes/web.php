<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Employee\AttendanceController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
    ->name('dashboard');

    Route::resource('employees', \App\Http\Controllers\Admin\EmployeeController::class);

    Route::get('/attendance', [\App\Http\Controllers\Admin\AttendanceAdminController::class, 'index'])
    ->name('attendance.index');

    Route::get('/attendance/export/pdf', [\App\Http\Controllers\Admin\AttendanceAdminController::class, 'exportPdf'])
    ->name('attendance.export.pdf');

    Route::get('/attendance/export/excel', [\App\Http\Controllers\Admin\AttendanceAdminController::class, 'exportExcel'])
    ->name('attendance.export.excel');

});


Route::middleware(['auth', 'role:karyawan'])->prefix('employee')->name('employee.')->group(function () {

    Route::get('/dashboard', [\App\Http\Controllers\Employee\EmployeeDashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/attendance', [\App\Http\Controllers\Employee\AttendanceController::class, 'index'])
        ->name('attendance');

    Route::post('/attendance/check-in', [\App\Http\Controllers\Employee\AttendanceController::class, 'checkIn'])
        ->name('checkin');

    Route::post('/attendance/check-out', [\App\Http\Controllers\Employee\AttendanceController::class, 'checkOut'])
        ->name('checkout');

    Route::get('/history', [\App\Http\Controllers\Employee\AttendanceController::class, 'history'])
        ->name('history');
});



require __DIR__.'/auth.php';
