<?php


use rifrocket\LaravelCms\Http\Controllers\AdminControllers\AppMediaManagerControllers\AppMediaManagerController;
use rifrocket\LaravelCms\Http\Controllers\AdminControllers\AppSettingControllers\AppSettingController;
use rifrocket\LaravelCms\Http\Controllers\AdminControllers\DashboardController;
use rifrocket\LaravelCms\Http\Controllers\AuthControllers\LoginController;
use Illuminate\Support\Facades\Route;


//Route::group(array('domain' => config('lbs-laravel-cms.application.admin_route_domain').'.'.env('APP_DOMAIN'),'middleware'=>'web'), function () {
Route::group(array('middleware'=>'web'), function () {


    // Login and Logout
    Route::GET('/', [LoginController::class, 'showLoginForm'])->name('lbs.auth.admin.login');
    Route::GET('/logout', [LoginController::class, 'logout'])->name('lbs.auth.admin.logout');
//
//    // Password Resets
//    Route::POST('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('lbs.admin.password.email');
//    Route::GET('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('lbs.admin.password.request');
//    Route::POST('/password/reset', 'ResetPasswordController@reset');
//    Route::GET('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('lbs.admin.password.reset');
//    Route::GET('/password/change', 'AdminController@showChangePasswordForm')->name('lbs.admin.password.change');
//    Route::POST('/password/change', 'AdminController@changePassword');
//
    Route::GET('/dashboard', [DashboardController::class, 'dashboard'])->name('lbs.admin.dashboard');


    Route::group(array('prefix'=>'dashboard'),function (){

        //App Setting Routes
        Route::GET('/app-media', [AppMediaManagerController::class, 'mediaManager'])->name('lbs.admin.dashboard.mediaManager');
        Route::GET('/app-setting', [AppSettingController::class, 'listAppSettings'])->name('lbs.admin.dashboard.listAppSettings');
    });




    Route::fallback([DashboardController::class,'error404']);
//
//    Route::GET('/user-login', [LoginController::class, 'showLoginForm'])->name('login');
});
