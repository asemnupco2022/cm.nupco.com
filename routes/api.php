<?php

use App\Http\Controllers\HosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//HOS API
// Route::group(['prefix'=>'hos-api', 'middleware'=>'lbs_api_token'], function(){
    Route::group(['prefix'=>'hos-api'], function(){
    Route::any('vendor-response-to-line',[HosController::class,'vendorResponse'])->name('web.route.vendor.manager.list');
    Route::any('asn-status',[HosController::class,'HosAsnManager'])->name('web.route.asn.manager.list');
});
