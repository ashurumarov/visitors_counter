<?php

use App\Http\Controllers\CountryVisitorsStatisticsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => '/countries'], function() {
    Route::post('/visitors/update', [CountryVisitorsStatisticsController::class, 'updateCountryVisitors']);
    Route::get('/visitors/get', [CountryVisitorsStatisticsController::class, 'getCountriesVisitors']);
});
