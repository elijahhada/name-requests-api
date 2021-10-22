<?php

use App\Http\Controllers\NameController;
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

Route::prefix('requests')->group(function () {
    Route::post('add', [NameController::class, 'store']);
    Route::get('list', [NameController::class, 'list']);
    Route::post('decide', [NameController::class, 'decide']);
    Route::post('filtered', [NameController::class, 'filtered']);
});;