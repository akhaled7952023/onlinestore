<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\WelcomeController;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Auth\ResetPasswordController;
use App\Http\Controllers\Dashboard\Auth\ForgetPasswordController;

Route::group([
    'prefix' => LaravelLocalization::setLocale() . '/dashboard',
    'as' => 'dashboard.',
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
    ################# Auth ##############################
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

 ################################# Reset Password #############################
 Route::group(['prefix' => 'password', 'as' => 'password.'], function () {

    Route::controller(ForgetPasswordController::class)->group(function () {
        Route::get('email',          'showEmailForm')->name('email');
        Route::post('email',         'sendOtp')->name('email.post');
        Route::get('verify/{email}', 'showOtpForm')->name('verify');
        Route::post('verify/',       'verifyOtp')->name('verify.post');
    });
    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('reset/{email}', 'showResetForm')->name('reset');
        Route::post('reset',         'resetPassword')->name('reset.post');
    });
});
################################## End Pssword #################################

    ################# Protected Routed  ##############################
    Route::group(['middleware' => 'auth:admin'], function () {
    ####################################### Welcome Routes #######################################
        Route::get('welcome', [WelcomeController::class, 'index'])->name('welcome');
    });


});

