<?php

use App\Http\Controllers\auth\authController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//routes with no auth
Route::post('create',[authController::class,'create']);
