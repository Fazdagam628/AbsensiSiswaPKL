<?php

use App\Livewire\Presensi;
use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::group(['middleware' => 'auth'], function () {
    Route::get('presensi', Presensi::class)->name("presensi");
    Route::get('attendance/export', function () {
        return Excel::download(new AttendanceExport, 'attendance.xlsx');
    })->name('attendance-export');
});

Route::get('/login', function () {
    return redirect('admin/login');
})->name('login');

Route::get('/', function () {
    return redirect('/admin');
});
Route::get('/symlink', function () {
    Artisan::call('storage:link');
});