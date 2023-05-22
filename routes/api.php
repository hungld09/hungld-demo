<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

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

Route::group(['prefix' => 'task'], function () {
    Route::get('/', [TaskController::class, 'getList']);
    Route::post('/', [TaskController::class, 'create']);
    Route::put('/{id}', [TaskController::class, 'update']);
    Route::patch('/{id}', [TaskController::class, 'updateStatus']);
    Route::delete('/{id}', [TaskController::class, 'delete']);
});
