<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\WelcomeController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale() . '/dashboard',
    'as' => 'dashboard.',
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
    ################# Auth ##############################
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');

    ################# Protected Routed  ##############################
    Route::group(['middleware' => 'auth:admin'], function () {
    ####################################### Welcome Routes #######################################
        Route::get('welcome', [WelcomeController::class, 'index'])->name('welcome');
    });


});

