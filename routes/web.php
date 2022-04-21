<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\PDFController;
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
Route::resource('employees', EmployeeController::class);
Route::resource('attendances', AttendanceController::class);
Route::post('mark_attendance', [AttendanceController::class, 'store'])->name('mark_attendance');
Route::get('/status/{statusId}', [AttendanceController::class, 'showById']);
Route::get('create', [DocumentController::class, 'create'])->name('create');
Route::post('store', [DocumentController::class, 'store']) ->name('store');
Route::post('generate-pdf', [PDFController::class, 'generatePDF']);
Route::get('generate-pdf', [PDFController::class, 'generatePDF'])->name('generate-pdf');

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => 'auth'], function() {
    Route::get('/changePassword',[ChangePasswordController::class, 'showChangePasswordGet'])->name('changePasswordGet');
    Route::post('/changePassword',[ChangePasswordController::class, 'store'])->name('changePasswordPost');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
