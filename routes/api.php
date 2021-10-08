<?php

use App\Http\Controllers\HosController;
use Illuminate\Http\Request;
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
Route::group(['prefix'=>'hos-api'], function(){
    Route::post('/vendor-response-to-line',[HosController::class,'index'])->name('web.route.vendor.manager.list');
});
