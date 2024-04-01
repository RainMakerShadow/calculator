<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoadDataController;
use App\Http\Controllers\RecordingDataController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/data', [LoadDataController::class, "index"]);
Route::post('/calculation_results',[RecordingDataController::class,'index' ]);
Route::get('/calculation_results',[RecordingDataController::class,'index' ]);
