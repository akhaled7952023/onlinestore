<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\WelcomeController;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Auth\ResetPasswordController;
use App\Http\Controllers\Dashboard\Auth\ForgetPasswordController;
use App\Http\Controllers\Dashboard\ManageAdminsController;
use App\Http\Controllers\Dashboard\ManagerAdminsController;
use App\Http\Controllers\Dashboard\ManagerUsersController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\DashBoard\WordlController;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/dashboard',
        'as' => 'dashboard.',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {
        ################# Auth ##############################
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.post');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        ################################# Reset Password #############################
        Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
            Route::controller(ForgetPasswordController::class)->group(function () {
                Route::get('email', 'showEmailForm')->name('email');
                Route::post('email', 'sendOtp')->name('email.post');
                Route::get('verify/{email}', 'showOtpForm')->name('verify');
                Route::post('verify/', 'verifyOtp')->name('verify.post');
            });
            Route::controller(ResetPasswordController::class)->group(function () {
                Route::get('reset/{email}', 'showResetForm')->name('reset');
                Route::post('reset', 'resetPassword')->name('reset.post');
            });
        });
        ################################## End Pssword #################################

        ################# Protected Routed  ##############################
        Route::group(['middleware' => 'auth:admin'], function () {
            ####################################### Welcome Routes #######################################
            Route::get('welcome', [WelcomeController::class, 'index'])->name('welcome');

            ####################################### Welcome Routes #######################################
            Route::resource('admins', ManageAdminsController::class);
            Route::get('profile', [ManageAdminsController::class, 'profile'])->name('admins.profile');
            Route::patch('profile', [ManageAdminsController::class, 'updateProfile'])->name('admins.profile.update');

             ############################ Shipping & Countries ##########################
            Route::group(['middleware' => 'can:global_shipping'], function () {
                Route::controller(WordlController::class)->group(function () {

                    Route::prefix('countries')->name('countries.')->group(function () {
                        Route::get('/',                              'getAllCountries')->name('index');
                        Route::get('/governorates', 'getAllGovernoratesInSystem')->name('getAllGovernorates');
                        Route::get('/{country_id}/governorates',     'getGovByCountryId')->name('governorates.index');
                        Route::get('/change-status/{country_id}',    'changeStatus')->name('status');

                    });

                    Route::prefix('governorates')->name('governorates.')->group(function () {
                        Route::get('/cities', 'getAllCitiesInSystem')->name('getAllCities');
                        Route::get('/{gov_id}/cities',     'getCitiesByGovId')->name('cities.index');
                        Route::get('/change-status/{gov_id}',       'changeGovStatus')->name('status');
                        Route::put('/shipping-price',               'changeShippingPrice')->name('shipping-price');
                    });
                    Route::prefix('cities')->name('cities.')->group(function () {

                        Route::get('/change-status/{city_id}',       'changeCityStatus')->name('status');
                        Route::put('/shipping-price',               'changeShippingPrice')->name('shipping-price');
                        Route::get('/search', 'searchCities')->name('search');
                    });

                });
            });
            ############################### End Shipping ###############################
        });
    },
);
