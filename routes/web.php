<?php

use App\Http\Controllers\Automation\AutoController;
use App\Http\Controllers\Filters\FilterController;
use App\Http\Controllers\Logs\UserLogController;
use App\Http\Controllers\Po\PoImportController;
use App\Http\Controllers\Staffs\StaffController;
use Illuminate\Support\Facades\Artisan;
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
    return view('welcome');
});

Route::group(array('middleware'=>'web'), function () {

    Route::get('import-pos',[PoImportController::class,'importPO'])->name('web.route.po.import');
    Route::get('sap-pos',[PoImportController::class,'SAPTable'])->name('web.route.po.SAPTable');
    Route::get('mowared-pos',[PoImportController::class,'MawTable'])->name('web.route.po.MawTable');
    Route::get('sap-line-items-po/{slug}',[PoImportController::class,'SAPTableLineItem'])->name('web.route.po.SAPTableLineItem');
    Route::get('mow-line-items-po/{slug}',[PoImportController::class,'MawTableLineItem'])->name('web.route.po.MawTableLineItem');

    //LOGS
    Route::group(['prefix'=>'filters'], function(){
        Route::get('/',[FilterController::class,'index'])->name('web.route.filters.index');
    });


    //AUTOMATION
    Route::group(['prefix'=>'automation'], function(){
        Route::get('/',[AutoController::class,'index'])->name('web.route.automation.list');
        Route::get('/automation-history',[AutoController::class,'automationHistory'])->name('web.route.automation.history');
    });

    //LOGS
    Route::group(['prefix'=>'logs'], function(){
        Route::get('staff-logs',[UserLogController::class,'index'])->name('web.route.logs.staff.logs');
    });

    //TICKET MANAGER
    Route::group(['prefix'=>'ticket-manager'], function(){
        Route::get('/',[AutoController::class,'index'])->name('web.route.ticket.manager.list');
        Route::get('/chat/{token}',[AutoController::class,'automationHistory'])->name('web.route.ticket.manager.chat');
    });


    //TICKET MANAGER
    Route::group(['prefix'=>'staff-manager'], function(){
        Route::get('/',[StaffController::class,'index'])->name('web.route.staff.manager.list');
        Route::get('/chat/{token}',[AutoController::class,'automationHistory'])->name('web.route.ticket.manager.chat');
    });



    Route::get('/clear-cache', function () {
        Artisan::call('cache:clear');
        return 'cache cleared';
    });

});


