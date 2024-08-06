<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
});

Route::middleware(['auth', 'employee'])->group(function () {
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
    Route::post('/employee/clock-in', [EmployeeController::class, 'clockIn'])->name('employee.clockIn');
    Route::post('/employee/break-start/{id}', [EmployeeController::class, 'breakStart'])->name('employee.breakStart');
    Route::post('/employee/break-end/{id}', [EmployeeController::class, 'breakEnd'])->name('employee.breakEnd');
    Route::post('/employee/clock-out/{id}', [EmployeeController::class, 'clockOut'])->name('employee.clockOut');
});

require __DIR__.'/auth.php';
