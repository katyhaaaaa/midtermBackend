<?php

use App\Http\Controllers\NovelController;
use App\Http\Controllers\AuthController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware'=>'auth:api'], function(){
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout',[AuthController::class, 'logout']);

    Route::post('/novels/search', [NovelController::class, 'search']);
    Route::post('/novels', [NovelController::class, 'store']);
    Route::get('/novels', [NovelController::class, 'index']);
    Route::get('/novels/{novel}', [NovelController::class, 'show']);
    Route::put('/novels/{novel}', [NovelController::class, 'update']);
    Route::delete('/novels/{novel}', [NovelController::class, 'destroy']);
});
