<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\StudentController;

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

Route::prefix('v1')->group(function() {
    Route::get('student', [StudentController::class, 'index']);
    Route::get('student/show/{id?}', [StudentController::class, 'show']);
    Route::post('student', [StudentController::class, 'store']);
    Route::put('student/edit/{id}', [StudentController::class, 'update']);
    Route::delete('student/edit/{id}', [StudentController::class, 'delete']);
});

