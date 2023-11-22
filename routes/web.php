<?php

use App\Http\Controllers\{StaffController, StudentController, TrackController};
use App\Http\Controllers\Auth\LoginController;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login/email', [LoginController::class, 'loginView'])->name('login.view');
Route::get('/login/phone-number', [LoginController::class, 'loginPage'])->name('login.page');
Route::post('/login/phone-number/post', [LoginController::class, 'loginPhone'])->name('login.phone');

// Staff
Route::prefix('staff')->group(function () {
    Route::get('index', [StaffController::class, 'index'])->name('staff.index');

    Route::prefix('{user}')->group(function () {
        Route::get('view', [StaffController::class, 'show'])->name('staff.show');
    });
});

// Student
Route::prefix('student')->group(function () {
    Route::get('index', [StudentController::class, 'index'])->name('student.index');

    Route::prefix('{user}')->group(function () {
        Route::get('view', [StudentController::class, 'show'])->name('student.show');

        Route::prefix('parcel')->group(function () {
            Route::get('create', [StudentController::class, 'parcelCreate'])->name('student.parcel.create');
            Route::post('store', [StudentController::class, 'parcelStore'])->name('student.parcel.store');
            Route::get('destroy/{parcel}', [StudentController::class, 'parcelDestroy'])->name('student.parcel.destroy');
        });
    });
});

// Track & Trace
Route::prefix('track-trace')->group(function () {
    Route::get('index', [TrackController::class, 'index'])->name('track.index');
});
