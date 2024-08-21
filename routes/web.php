<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\UserInterestController;
use App\Http\Controllers\PoliticalPartyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::apiResource('skills', SkillController::class);
Route::apiResource('interests', InterestController::class);
Route::apiResource('locations', LocationController::class);

Route::apiResource('user-interests', UserInterestController::class)->parameters([
    'user-interests' => 'userInterest'
]);

Route::apiResource('political-parties', PoliticalPartyController::class)->parameters([
    'political-parties' => 'politicalParty'
]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
