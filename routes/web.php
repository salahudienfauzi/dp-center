<?php

use App\Http\Controllers\{HistoryController, HomeController, PaymentController, StaffController, StudentController, TrackController};
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

Route::get('/login/email', [LoginController::class, 'loginView'])->name('login.view');
Route::get('/login/phone-number', [LoginController::class, 'loginPage'])->name('login.page');
Route::post('/login/phone-number/post', [LoginController::class, 'loginPhone'])->name('login.phone');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::post('/profile/post', [HomeController::class, 'profilePost'])->name('profile.post');

// Staff
Route::prefix('staff')->group(function () {
    Route::get('index', [StaffController::class, 'index'])->name('staff.index');

    Route::prefix('{user}')->group(function () {
        Route::get('view', [StaffController::class, 'show'])->name('staff.show');

        Route::prefix('parcel')->group(function () {
            Route::get('create', [StaffController::class, 'parcelCreate'])->name('staff.parcel.create');
            Route::post('store', [StaffController::class, 'parcelStore'])->name('staff.parcel.store');
            Route::get('destroy/{parcel}', [StaffController::class, 'parcelDestroy'])->name('staff.parcel.destroy');
        });
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

// Payment
Route::prefix('payment')->group(function () {
    Route::get('index', [PaymentController::class, 'index'])->name('payment.index');

    Route::prefix('{parcel}')->group(function () {
        Route::get('edit', [PaymentController::class, 'edit'])->name('payment.edit');
        Route::post('update', [PaymentController::class, 'update'])->name('payment.update');
        Route::get('receipt', [PaymentController::class, 'receipt'])->name('payment.receipt');
    });
});

// Histories
Route::prefix('history')->group(function () {
    Route::get('index', [HistoryController::class, 'index'])->name('history.index');

    Route::prefix('{parcel}')->group(function () {
        Route::get('show', [HistoryController::class, 'show'])->name('history.show');
    });
});
