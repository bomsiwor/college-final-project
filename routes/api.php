<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\MaintenanceController;
use App\Http\Controllers\Api\RadioactiveController;
use App\Http\Controllers\Api\ToolController;
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

Route::controller(\App\Http\Controllers\Api\AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});

// Attendance
Route::controller(AttendanceController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/attendance', 'index');
    Route::post('/attendance', 'store');
});

// Tool
Route::controller(ToolController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/tool', 'index');
    Route::get('/tool/{tool}', 'show');
    Route::post('/tool', 'store')->middleware('api_role');
    Route::put('/tool/{tool:inventory_unique}', 'update');
    Route::delete('/tool/{tool:inventory_unique}', 'destroy')->middleware('api_role');
});

// Radioactive
Route::controller(RadioactiveController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/radioactive', 'index');
    Route::get('/radioactive/{radioactive}', 'show');
    Route::post('/radioactive', 'store');
    Route::put('/radioactive/{radioactive:inventory_unique}', 'update');
    Route::delete('/radioactive/{radioactive:inventory_unique}', 'destroy');
});

// Maintenance
Route::controller(MaintenanceController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/maintenance', 'index');
    Route::get('/maintenance/{maintenance}', 'show');
    Route::post('/maintenance', 'store');
    Route::put('/maintenance/{maintenance}', 'update');
    Route::delete('/maintenance/{maintenance}', 'destroy');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json([
        'code' => 200,
        'success' => true,
        'message' => 'Sukses',
        'data' => $request->user()
    ]);
});
