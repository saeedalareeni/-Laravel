<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\auth\ResetPasswordController;
use App\Http\Controllers\Auth\verificationEmail;
use App\Http\Controllers\MessageController;
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

//  This Route For Login
Route::prefix('cms/')->middleware('guest:admin')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('auth.login');
    Route::post('login', [AuthController::class, 'login']);
});

// This Route For Email Verification
Route::prefix('email/')->middleware('auth:admin')->group(function () {
    Route::get('/', [verificationEmail::class, 'notic'])->name('verification.notice');
    Route::get('/verify/send', [verificationEmail::class, 'sendEmail'])->middleware('throttle:5,5')->name('sendEmailVerification');
    Route::get('/send/{id}/{hash}', [verificationEmail::class, 'sendEmailVerification'])->name('verification.verify');
});

// This Route For Welcome Page & admin controller
Route::prefix('cms/')->middleware('auth:admin', 'verified')->group(function () {
    Route::view('home', 'cms.welcome');
    Route::resource('admin', AdminController::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout')->withoutMiddleware('verified');
});

// This Route For Forgot Password
Route::prefix('password/')->group(function () {
    Route::get('forgot-password', [ResetPasswordController::class, 'forgotPassword'])->name('forgot-password');
    Route::post('SendResetPassword', [ResetPasswordController::class, 'SendResetPassword'])->name('sendResetPassword');
    Route::get('resetpassword/{token}', [ResetPasswordController::class, 'resetpassword'])->name('password.reset');
    Route::post('/update-password', [ResetPasswordController::class, 'updatePassword'])->name('updatePassword');
});

// This Route Fro Student operations
Route::prefix('message/')->middleware('auth:admin')->group(function () {
    Route::get('/', [MessageController::class, 'index'])->name('message.index');
    Route::get('show/{id}', [MessageController::class, 'show'])->name('message.show');
    Route::get('replay/{id}', [MessageController::class, 'edit'])->name('message.replay');
    Route::post('replay/{id}', [MessageController::class, 'update'])->name('message.replayDone');
    Route::get('/send', [MessageController::class, 'create'])->withoutMiddleware('auth:admin');
    Route::post('/', [MessageController::class, 'store'])->name('message.store')->withoutMiddleware('auth:admin');
});

