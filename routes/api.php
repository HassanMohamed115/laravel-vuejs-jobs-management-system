<?php

use App\Http\Controllers\JobController;
use Illuminate\Http\Request;
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

Route::get('jobs',[JobController::class,'index']);
Route::post('jobs',[JobController::class,'store']);
Route::get('jobs/{id}',[JobController::class,'show_job']);
Route::put('jobs/{id}',[JobController::class,'update']);
Route::delete('jobs/{id}',[JobController::class,'destroy']);
