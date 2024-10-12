<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\UserVaccineController;
use App\Http\Controllers\API\V1\VaccineCenterController;

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
Route::prefix('v1')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('users', UserController::class)->only('index');

        Route::apiResource('vaccine-centers', VaccineCenterController::class)->only('index');

        Route::apiResource('user-vaccines', UserVaccineController::class)->parameters([
            'user-vaccines' => 'userVaccine'
        ]);

        Route::get('/unscheduled-users', [UserController::class, 'unscheduledUserIndex'])->name('users.unscheduled');
    });
});
