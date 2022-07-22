<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MahasiswaController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('mahasiswas', MahasiswaController::class);

// Guest Routes
Route::group(['middleware' => ['guest']], function() {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// Public Routes
Route::get('/mahasiswas/search/{nama}', [MahasiswaController::class, 'search']);

// Protected Routes
Route::group(['middleware' => ['auth.basic.once']], function(){
    Route::group(['middleware' => ['auth.key']], function(){
        Route::get('/mahasiswas', [MahasiswaController::class, 'index']);
        Route::get('/mahasiswas/{mahasiswa}', [MahasiswaController::class, 'show']);
        Route::post('/mahasiswas', [MahasiswaController::class, 'store'])->middleware('throttle:1000, 1440');
        Route::put('/mahasiswas/{mahasiswa}', [MahasiswaController::class, 'update']);
        Route::delete('/mahasiswas/{mahasiswa}', [MahasiswaController::class, 'destroy']);
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/createApiKey', [AuthController::class, 'createApiKey'])->middleware('throttle:1,10');
});
