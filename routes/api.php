<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\MyUserController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\UserInterestController;
use App\Http\Controllers\PoliticalPartyController;
use App\Http\Controllers\UserLocationController;
use App\Http\Controllers\UserSkillController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\UserPoliticalPartyController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::apiResource('skills', SkillController::class);
    Route::apiResource('interests', InterestController::class);
    Route::apiResource('locations', LocationController::class);

    Route::apiResource('political-parties', PoliticalPartyController::class)->parameters([
        'political-parties' => 'politicalParty'
    ]);

    Route::resource('user-interests', UserInterestController::class)->parameters([
        'user-interests' => 'userInterest'
    ]);

    Route::apiResource('user-locations', UserLocationController::class)->parameters([
        'user-locations' => 'userLocation'
    ]);

    Route::apiResource('user-political-parties', UserPoliticalPartyController::class)->parameters([
        'user-political-parties' => 'userPoliticalParty'
    ]);

    Route::apiResource('user-skills', UserSkillController::class)->parameters([
        'user-skills' => 'userSkill'
    ]);

    Route::apiResource('user-types', UserTypeController::class)->parameters([
        'user-types' => 'userType'
    ])->only('index');

    Route::get('/my-users/{id}', [MyUserController::class, 'index'])->name('my-users');
});
