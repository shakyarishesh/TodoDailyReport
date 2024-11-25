<?php

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/', function () {
    return view('login');
});



//register post
Route::post('/registerPost',[RegistrationController::class,'register']);

//login post
Route::post('/loginPost',[RegistrationController::class,'login']);
Route::post('/logout', [RegistrationController::class, 'logout'])->middleware('auth:sanctum');


//report post
Route::post('/reportPost',[ReportController::class,'reportPost'])->middleware('auth:sanctum');

//profile
// Route::view('/profile', 'profile');
Route::get('/reportGet',[ReportController::class,'reportGet'])->middleware('auth:sanctum');

