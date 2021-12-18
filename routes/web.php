<?php

use App\Http\Controllers\Automation\AutoController;
use App\Http\Controllers\Filters\FilterController;
use App\Http\Controllers\HosController;
use App\Http\Controllers\Logs\UserLogController;
use App\Http\Controllers\Po\PoImportController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Staffs\StaffController;
use App\Http\Controllers\TicketManagerController;
use App\Http\Controllers\UserExportController;
use App\Http\Controllers\Vendors\VendorController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
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



// Route::get('/import-po',[DashboardController::class,'importPO'])->name('web.route.po.import');
// Route::get('/read-po',[DashboardController::class,'readPO'])->name('web.route.po.read');


Route::group(array('middleware'=>'web'), function () {

    //DASHBOARD
    Route::group(['prefix'=>'dashboard'], function(){
        Route::get('/summary',[DashboardController::class,'summary'])->name('web.route.dashboard.summary');
        Route::get('/suppliers-performance',[DashboardController::class,'suppliers_performance'])->name('web.route.dashboard.suppliers_performance');
        Route::get('/tenders',[DashboardController::class,'tenders'])->name('web.route.dashboard.tenders');
        Route::get('/progress',[DashboardController::class,'progress'])->name('web.route.dashboard.progress');
        Route::get('/over-due',[DashboardController::class,'over_due'])->name('web.route.dashboard.over_due');
        Route::get('/contracts-expediting',[DashboardController::class,'contracts_expediting'])->name('web.route.dashboard.contracts_expediting');
    });


    //Expediting Management
    Route::group(['prefix'=>'expediting-management'], function(){

        //SAP REPORT SECTION
        Route::get('import-pos',[PoImportController::class,'importPO'])->name('web.route.po.import');
        Route::get('sap-pos',[PoImportController::class,'SAPTable'])->name('web.route.po.SAPTable');
        Route::get('mowared-pos',[PoImportController::class,'MawTable'])->name('web.route.po.MawTable');
        Route::get('sap-line-items-po/{slug}',[PoImportController::class,'SAPTableLineItem'])->name('web.route.po.SAPTableLineItem');
        Route::get('sap-line-items-po/v2',[PoImportController::class,'SAPTableLineItems'])->name('web.route.po.SAPTableLineItems');
        Route::get('mow-line-items-po/{slug}',[PoImportController::class,'MawTableLineItem'])->name('web.route.po.MawTableLineItem');

    });


    //Expediting Requests
    Route::group(['prefix'=>'expediting-requests'], function(){

        //TICKET MANAGER
        Route::group(['prefix'=>'ticket-manager'], function(){
        Route::get('/',[TicketManagerController::class,'index'])->name('web.route.ticket.manager.list');
        Route::get('chat/{token}',[TicketManagerController::class,'ticketChat'])->name('web.route.ticket.manager.chat');
        Route::get('/vendor-response-attachment-download',[TicketManagerController::class,'download_attachment'])->name('web.route.hos.vendor.download.attachment');
        });

    });



    //Expediting Control
    Route::group(['prefix'=>'expediting-control'], function(){

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


         //PROFILE MANAGER
         Route::group(['prefix'=>'export'], function(){
            Route::get('/',[UserExportController::class,'index'])->name('web.route.export');
            Route::get('/downlaod',[UserExportController::class,'downloadFile'])->name('web.route.export.downloadFile');
        });

    });




    //hos-api/vendor-response-to-line
    Route::group(['prefix'=>'hos'], function(){
        Route::get('/vendor-response',[ProfileController::class,'index'])->name('web.route.hos.vendor.response');
    });

    Route::get('/clear-cache', function () {
        Artisan::call('cache:clear');
        return 'cache cleared';
    });


    Route::get('/password-hash', function () {
        return Hash::make(123456789);
     });

});


