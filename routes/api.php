<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\DistanceController;
use App\Http\Controllers\TravelHistoryController;
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


Route::prefix('v1')->group(function () {
    Route::post('/newlogin', [UserAuthController::class, 'userLogin']);
    Route::post('/newregister', [UserAuthController::class, 'registerUser']);
    Route::post('/forgotpassword', [UserAuthController::class, 'forgot_password']);
    Route::post('/tokenconnfrm', [UserAuthController::class, 'token_connfrm']);
    Route::post('/changePassword', [UserAuthController::class, 'changePassword']);

    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('/updateprofle', [UserAuthController::class, 'updateProfile']);

        Route::post('/location', [TravelHistoryController::class, 'getLongitudeLatitude']);


        //............................Distance Calculation.................................//

        Route::get('/getCampaignDistanceCovered/{campaign_id}', [DistanceController::class, 'getCampaignDistanceCovered'])->name('getCampaignDistanceCovered');
        Route::get('/getDriverCampaignDistanceCoveredApi', [DistanceController::class, 'getDriverCampaignDistanceCoveredApi'])->name('getDriverCampaignDistanceCoveredApi');
    });
});
