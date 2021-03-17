<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DistanceController;
use App\Http\Controllers\ChartController;
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
    return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //...................................Campaign......................................//
    Route::get('/campaign/index', [CampaignController::class, 'index'])->name('campaign.index');
    Route::get('/campaign/create', [CampaignController::class, 'create'])->name('campaign.create');
    Route::post('/campaign/store', [CampaignController::class, 'store'])->name('campaign.store');
    Route::post('/campaign/update/{id}', [CampaignController::class, 'update'])->name('campaign.update');
    Route::get('/campaign/edit/{id}', [CampaignController::class, 'edit'])->name('campaign.edit');
    Route::get('/campaign/show/{id}', [CampaignController::class, 'show'])->name('campaign.show');
    Route::delete('/campaign/delete/{id}', [CampaignController::class, 'delete'])->name('campaign.delete');

    //...................................Drivers......................................//
    Route::get('/driver/index', [DriverController::class, 'index'])->name('driver.index');
    Route::get('/approve/driver/{id}', [DriverController::class, 'approveDriver'])->name('driver.approve');
    Route::get('/driver/create', [DriverController::class, 'create'])->name('driver.create');
    Route::post('/driver/store', [DriverController::class, 'store'])->name('driver.store');
    Route::post('/driver/update/{id}', [DriverController::class, 'update'])->name('driver.update');
    Route::get('/driver/show/{id}', [DriverController::class, 'show'])->name('driver.show');
    Route::delete('/driver/delete/{id}', [DriverController::class, 'delete'])->name('driver.delete');
    Route::get('/driver/getmovements/{id}', [DriverController::class, 'movementsMapmarker'])->name('driver.movements');
    Route::get('/driver/movements/{id}', [DriverController::class, 'movements'])->name('driver.movements');
    Route::get('/driver/campaignmovements/{driver_id}/{campaign_id}', [DriverController::class, 'campaignMovements'])->name('driver.campaignmovements');

    //...................................Customers......................................//
    Route::get('/customer/index', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('/customer/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::get('/customer/show/{id}', [CustomerController::class, 'show'])->name('customer.show');
    Route::delete('/customer/delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');


    //............................Distance Calculation.................................//

    Route::get('/getCampaignDistanceCovered/{campaign_id}', [DistanceController::class, 'getCampaignDistanceCovered'])->name('getCampaignDistanceCovered');
    Route::get('/getDriverCampaignDistanceCovered/{driver_id}/{campaign_id}', [DistanceController::class, 'getDriverCampaignDistanceCovered'])->name('getDriverCampaignDistanceCovered');
    Route::get('/campaignMapMarker/{campaign_id}', [DistanceController::class, 'campaignMapMarker'])->name('campaignMapMarker');
    Route::get('/drivercampaignMapMarker/{driver_id}/{campaign_id}', [DistanceController::class, 'drivercampaignMapMarker'])->name('drivercampaignMapMarker');


	Route::get('/getmonths', [ChartController::class, 'getMonths'])->name('getMonths');
	Route::get('/getDays', [ChartController::class, 'getDays'])->name('getDays');
	Route::get('/getMonthlyCampaignDistance/{campaign_id}', [ChartController::class, 'getMonthlyCampaignDistance'])->name('getMonthlyCampaignDistance');
	Route::get('/getDailyCampaignDistance/{campaign_id}', [ChartController::class, 'getDailyCampaignDistance'])->name('getDailyCampaignDistance');
	Route::get('/getMonthlyCompletedOrdersCount', 'ChartController@getMonthlyCompletedOrdersCount')->name('getMonthlyCompletedOrdersCount');
	Route::get('/getMonthlyCancelledOrdersCount', 'ChartController@getMonthlyCancelledOrdersCount')->name('getMonthlyCancelledOrdersCount');
	Route::get('/getMonthlyReturnOrdersCount', 'ChartController@getMonthlyReturnOrdersCount')->name('getMonthlyReturnOrdersCount');
	Route::get('/getMonthlyOrdersData', 'ChartController@getMonthlyOrdersData')->name('getMonthlyOrdersData');

});
