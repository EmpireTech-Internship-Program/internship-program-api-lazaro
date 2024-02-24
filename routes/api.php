<?php

use App\Http\Controllers\api\V1\AccountController;
use App\Http\Controllers\api\V1\AgencyController;
use App\Http\Controllers\api\V1\BankController;
use App\Http\Controllers\api\V1\PersonController;
use App\Http\Controllers\api\V1\UserController;
use App\Http\Controllers\AuthController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {
    Route::get('/user', [UserController::class, 'index']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user/{user}', [UserController::class, 'show']);
        Route::put('/profile/{user}', [UserController::class, 'update']);
        Route::apiResource('/banks', BankController::class);
        Route::apiResource('/agencies', AgencyController::class);
        Route::apiResource('/accounts', AccountController::class);
        Route::apiResource('/people', PersonController::class);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
    
    Route::post('/user', [UserController::class, 'store']);
    Route::post('/login', [AuthController::class, 'login']);
});