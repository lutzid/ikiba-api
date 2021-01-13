<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;

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

Route::post('/place', [PlaceController::class, 'create']);
Route::get('/place', [PlaceController::class, 'getPlacesByType']);
Route::get('/places', [PlaceController::class, 'getPlaces']);
Route::put('/place', [PlaceController::class, 'update']);
Route::post('/place/{id}', [PlaceController::class, 'delete']);
