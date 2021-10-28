<?php

use App\Http\Controllers\Automation\AutoController;
use App\Http\Controllers\Filters\FilterController;
use App\Http\Controllers\HosController;
use App\Http\Controllers\Logs\UserLogController;
use App\Http\Controllers\Po\PoImportController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Staffs\StaffController;
use App\Http\Controllers\TicketManagerController;
use App\Http\Controllers\Vendors\VendorController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use rifrocket\LaravelCms\Http\Controllers\AdminControllers\DashboardController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/import-po',[DashboardController::class,'importPO'])->name('web.route.po.import');
Route::get('/read-po',[DashboardController::class,'readPO'])->name('web.route.po.read');
Route::get('/vendor-import',[DashboardController::class,'importCsv'])->name('web.route.po.importCsv');

Route::group(array('middleware'=>'web'), function () {

    Route::get('import-pos',[PoImportController::class,'importPO'])->name('web.route.po.import');
    Route::get('sap-pos',[PoImportController::class,'SAPTable'])->name('web.route.po.SAPTable');
    Route::get('mowared-pos',[PoImportController::class,'MawTable'])->name('web.route.po.MawTable');
    Route::get('sap-line-items-po/{slug}',[PoImportController::class,'SAPTableLineItem'])->name('web.route.po.SAPTableLineItem');
    Route::get('sap-line-items-po/v2',[PoImportController::class,'SAPTableLineItems'])->name('web.route.po.SAPTableLineItems');
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
        Route::get('/',[TicketManagerController::class,'index'])->name('web.route.ticket.manager.list');
        Route::get('chat/{token}',[TicketManagerController::class,'ticketChat'])->name('web.route.ticket.manager.chat');
    });


    //STAFF MANAGER
    Route::group(['prefix'=>'staff-manager'], function(){
        Route::get('/',[StaffController::class,'index'])->name('web.route.staff.manager.list');
    });


    //VENDOR MANAGER
    Route::group(['prefix'=>'vendor-manager'], function(){
        Route::get('/',[VendorController::class,'index'])->name('web.route.vendor.manager.list');
    });


    //PROFILE MANAGER
    Route::group(['prefix'=>'profile'], function(){
        Route::get('/',[ProfileController::class,'index'])->name('web.route.profile');
    });



//    hos-api/vendor-response-to-line
    Route::group(['prefix'=>'hos'], function(){
        Route::get('/vendor-response',[ProfileController::class,'index'])->name('web.route.hos.vendor.response');
    });

    Route::get('/clear-cache', function () {
        Artisan::call('cache:clear');
        return 'cache cleared';
    });




});


